<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUpsertRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function generateSlug($title)
    {
        $counter = 0;

        do {
            // creo uno slug e se il counte e maggiore di 0, concateno il counter
            $slug = Str::slug($title) . ($counter > 0 ? "-" . $counter : "");

            // cerco se esiste gia un elemento con questo slug
            $alreadyExists = Project::where("slug", $slug)->first();

            $counter++;
        } while ($alreadyExists); // ripeto il ciclo finche esiste gia un elemento con questo slug aggiungendo -$counter

        return $slug;
    }

    public function extractPercentages($languages_used)
    {
        return array_map(function ($language) {
            return floatval(preg_replace('/[^0-9.]/', '', $language));
        }, $languages_used);
    }

    public function index()
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            $project->convertedPercentages = $this->extractPercentages($project->languages_used);
        }

        return view('admin.projects.index', compact('projects'));
    }

    public function show($slug)
    {
        $projects = Project::where('slug', $slug)->first();
        $projects->convertedPercentages = $this->extractPercentages($projects->languages_used);

        return view('admin.projects.show', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(ProjectUpsertRequest $request)
    {
        $data = $request->validated();
        $data['image'] = Storage::put('projects', $data['image']);
        $data["slug"] = $this->generateSlug($data["title"]);
        $data["languages_used"] = explode(",", $data["languages_used"]);

        $project = Project::create($data);

        return redirect()->route('admin.projects.show', $project->slug);
    }

    public function edit($slug)
    {
        $project = Project::where('slug', $slug)->first();

        return view("admin.projects.edit", ["project" => $project]);
    }

    public function update(ProjectUpsertRequest $request, $slug)
    {
        $data = $request->validated();
        $project = Project::where('slug', $slug)->first();
        if (key_exists("image", $data)) {
            // carico il nuovo file
            // salvo in una variabile temporanea il percorso del nuovo file
            $data['image'] = Storage::put('projects', $data['image']);

            // Dopo aver caricato la nuova immagine, PRIMA di aggiornare il db,
            // cancelliamo dallo storage il vecchio file.
            // $post->cover_img // vecchio file
            Storage::delete($project->image);
        }

        // rigenerazione slug
        if ($data["title"] !== $project->title) {
            $data["slug"] = $this->generateSlug($data["title"]);
        }

        $data["languages_used"] = explode(",", $data["languages_used"]);

        $project->update($data);
        return redirect()->route('admin.projects.show', $project->slug);
    }

    public function destroy($slug) {
        $project = Project::where('slug', $slug)->first();

        if ($project->image) {
            Storage::delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}

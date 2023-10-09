<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUpsertRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function extractPercentages($languages_used){
        return array_map(function($language){
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

        $counter = 0;

        do {
            // creo uno slug e se il counte e maggiore di 0, concateno il counter
            $slug = Str::slug($data["title"]) . ($counter > 0 ? "-" . $counter : "");

            // cerco se esiste gia un elemento con questo slug
            $alreadyExists = Project::where("slug", $slug)->first();

            $counter++;
        } while ($alreadyExists); // ripeto il ciclo finche esiste gia un elemento con questo slug aggiungendo -$counter

        $data["slug"] = Str::slug($data["title"]);
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
        $project = Project::where('slug', $slug)->first();

        $data = $request->validated();

        $data["languages_used"] = explode(",", $data["languages_used"]);

        $project->update($data);
        return redirect()->route('admin.projects.show', $project->slug);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->first();

        return view('admin.projects.show', compact('project'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'github_url' => 'required',
            'languages_used' => 'required',
            'description' => 'required',
        ]);

        // cerca di capire perche non funziona guarda nello show.blade.php
        $percentages = [];

        // Estrai le percentuali dai linguaggi utilizzati
        foreach ($data['languages_used'] as $language) {
            preg_match('/\d+(\.\d+)?/', $language, $matches);
            if (!empty($matches)) {
                $percentages[] = (float)$matches[0];
            }
        }

        // Salva le percentuali come JSON
        $data['percentages'] = json_encode($percentages);

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

    public function update(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->first();

        $data = $request->validate([
            'title' => 'required',
            'image' => 'required',
            'github_url' => 'required',
            'languages_used' => 'required',
            'description' => 'required',
        ]);

        $data["languages_used"] = explode(",", $data["languages_used"]);

        $project->update($data);
        return redirect()->route('admin.projects.show', $project->slug);
    }
}

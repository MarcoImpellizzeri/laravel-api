@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold text-center text-uppercase">{{ $project->title }}</h1>
        <div class="language-percentages">
            <h2>Linguaggi e Percentuali:</h2>
            @foreach ($languages_used as $language)
                <div>
                    <span>{{ $language }}</span>
                    <span>{{ $percentages }}%</span>
                </div>
            @endforeach
        </div>
        <img src="{{ asset($project->image) }}" class="card-img-top" alt="image not found" class="img-fluid">
        <p class="card-text">{{ $project->description }}</p>
        <a href="{{ $project->github_url }}" class="btn btn-primary" target="_blank">
            <i class="fa-brands fa-github"></i>
        </a>
        <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-primary">
            Modifica
        </a>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <h1 class="fw-bold text-center text-uppercase">I miei Progetti</h1>

        <a href="{{ route('admin.projects.create') }}" class="btn btn-warning my-3">Aggiungi progetto</a>

        <div class="row row-col-3">
            @foreach ($projects as $project)
                <div class="col">
                    <div class="card">
                        <a href="{{ route('admin.projects.show', $project->slug) }}">
                            <img src="{{ asset($project->image) }}" class="card-img-top" alt="image not found">
                            <div class="card-body">
                                <h5 class="card-title">{{ $project->title }}</h5>
                                <small class="card-text">Linguaggi
                                    utilizzati:{{ implode(', ', $project->languages_used) }}</small>
                                <p class="card-text">{{ $project->description }}</p>
                                <div>
                                    <a href="{{ $project->github_url }}" class="btn btn-primary" target="_blank">
                                        <i class="fa-brands fa-github"></i>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="fw-bold text-center text-uppercase pb-3">I miei Progetti</h1>

        <div class="row row-cols-xs-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($projects as $project)
                <div class="col">
                    <a href="{{ route('admin.projects.show', $project->slug) }}" class="text-dark">
                        <div class="card">
                            <img src="{{ asset('storage/' . $project['image']) }}" class="card-img-top" alt="image not found">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title">{{ $project->title }}</h5>
                                    <p class="card-text">{{ $project->description }}</p>
                                    <small class="card-text text-black">
                                        {{ $project->type->name }} ({{ $project->type->description }})
                                    </small>
                                    <div>
                                        <small class="card-text">
                                            linguaggi utilizzati:
                                            @foreach ($project->languages_used as $index => $language)
                                                <div style="margin-bottom: 10px;">
                                                    <div>{{ $language }}</div>
                                                    <div
                                                        style="width: {{ $project->convertedPercentages[$index] }}%; height: 5px; background-color: #0D6EFD; border-radius: 5px;">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ $project->github_url }}" class="text-black fs-3" target="_blank">
                                        <i class="fa-brands fa-github"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

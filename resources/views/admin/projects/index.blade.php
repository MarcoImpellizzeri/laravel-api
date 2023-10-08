@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <h1 class="fw-bold text-center text-uppercase pb-3">I miei Progetti</h1>

        <div class="row row-col-3">
            @foreach ($projects as $project)
                <div class="col">
                    <div class="card">
                        <a href="{{ route('admin.projects.show', $project->slug) }}">
                            <img src="{{ asset($project->image) }}" class="card-img-top" alt="image not found">
                            <div class="card-body">
                                <h5 class="card-title">{{ $project->title }}</h5>
                                <small class="card-text">
                                    linguaggi utilizzati:
                                    @foreach ($project->languages_used as $index => $language)
                                        <div style="margin-bottom: 10px;">
                                            <div>{{ $language }}</div>
                                            <div
                                                style="width: {{ $project->convertedPercentages[$index] }}%; height: 5px; background-color: gray; border-radius: 5px;">
                                            </div>
                                        </div>
                                    @endforeach
                                </small>
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

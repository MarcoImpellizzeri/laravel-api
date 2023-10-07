@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold text-center text-uppercase">{{ $project->title }}</h1>
        <div><small>{{ implode(', ', $project->languages_used) }}</small></div>
        <img src="{{ asset($project->image) }}" class="card-img-top" alt="image not found" class="img-fluid">
        <p class="card-text">{{ $project->description }}</p>
        <a href="{{ $project->github_url }}" class="btn btn-primary" target="_blank">
            <i class="fa-brands fa-github"></i>
        </a>
    </div>
@endsection

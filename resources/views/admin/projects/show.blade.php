@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold text-center text-uppercase">{{ $project->title }}</h1>
        <div><small>{{ $project->languages_used }}</small></div>
        <img src="{{ $project->image }}" class="card-img-top" alt="image not found" class="img-fluid">
        <p class="card-text">{{ $project->description }}</p>
        <a href="{{ $project->githun_url }}" class="btn btn-primary">
            <i class="fa-brands fa-github"></i>
        </a>
    </div>
@endsection

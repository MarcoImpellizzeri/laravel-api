@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold text-center text-uppercase">{{ $projects->title }}</h1>
        <img src="{{ asset($projects->image) }}" class="card-img-top" alt="image not found" class="img-fluid">
        <p class="card-text">{{ $projects->description }}</p>
        <h4>Linguaggi Utilizzati:</h4>
        @foreach ($projects->languages_used as $index => $language)
            <div style=" align-items: center; margin-bottom: 10px;">
                <div>{{ $language }}</div>
                <div
                    style="margin-top: 2px; width: {{ $projects->convertedPercentages[$index] }}%; height: 5px; background-color: gray; border-radius: 5px;">
                </div>
            </div>
        @endforeach
        <a href="{{ $projects->github_url }}" class="btn btn-primary" target="_blank">
            <i class="fa-brands fa-github"></i>
        </a>
        <a href="{{ route('admin.projects.edit', $projects->slug) }}" class="btn btn-primary">
            Modifica
        </a>
    </div>
@endsection

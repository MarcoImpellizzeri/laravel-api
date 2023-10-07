@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <h1 class="fw-bold text-center text-uppercase">I miei Progetti</h1>

        <a href="{{ route('admin.projects.create') }}" class="btn btn-warning my-3">Aggiungi progetto</a>

        <div class="row row-col-3">
            @foreach ($projects as $project)
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $project->image }}" class="card-img-top" alt="image not found">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <small class="card-text">Linguaggi utilizzati:{{ $project->languages_used }}</small>
                            <p class="card-text">{{ $project->description }}</p>
                            <div>
                                <a href="{{ $project->githun_url }}" class="btn btn-primary">
                                    <i class="fa-brands fa-github"></i>
                                </a>
                                <a href="{{ route('admin.projects.show', $project->slug) }}" 
                                    class="btn btn-primary ms-2">
                                    Dettagli
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

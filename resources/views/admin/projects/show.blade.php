@extends('layouts.app')

@section('content')
    <div class="container my-show-container pb-5 px-0">
        <img src="{{ asset('storage/' . $projects['image']) }}" class="card-img-top" alt="image not found">
        <div class="d-flex py-3 px-5 aling-items-center justify-content-between">
            <h1 class="fw-bold text-uppercase m-0">{{ $projects->title }}</h1>
            
            <div>
                <a href="{{ $projects->github_url }}" class="text-black fs-2 aling-self-end"
                    target="_blank">
                    <i class="fa-brands fa-github"></i>
                </a>
            </div>
        </div>
        <div class="p-5 d-flex">
            <div class="container-left">
                <h5>Descrizione:</h5>
                <p class="card-text">{{ $projects->description }}</p>
                <small class="card-text text-black">
                    {{ $projects->type->name }} ({{ $projects->type->description }})
                </small>
            </div>
            <div class="container-right">
                <h5>Linguaggi Utilizzati:</h5>
                @foreach ($projects->languages_used as $index => $language)
                    <div style=" align-items: center; margin-bottom: 10px;">
                        <div>{{ $language }}</div>
                        <div
                            style="margin-top: 2px; width: {{ $projects->convertedPercentages[$index] }}%; height: 5px; background-color: #0D6EFD; border-radius: 5px;">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex ps-5">
            <a href="{{ route('admin.projects.edit', $projects->slug) }}" class="me-2 btn btn-warning">
                Modifica
            </a>

            <form action="{{ route('admin.projects.destroy', $projects->slug) }}" method="POST">
                @csrf()
                @method('DELETE')

                <button class="btn btn-danger">Elimina</button>
            </form>
        </div>
    </div>
@endsection

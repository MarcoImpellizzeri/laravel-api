@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold py-3 text-uppercase">Inserisci i nuovi dati del tuo progetto</h1>

        <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf()

            @method('put')

            {{-- titolo --}}
            <div class="mb-3">
                <label class="form-labal">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ old('title', $project->title) }}">
                @error('title')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Descrizione --}}
            <div class="mb-3">
                <label class="form-labal">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- immagine --}}
            <div class="mb-3">
                <label class="form-labal">Carica immagine</label>
                @if ($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="" class="img-thumbnail"
                        style="width: 100px; display: block; margin: 5px 0;">
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    accept="image/*">
                @error('image')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- linguaggio --}}
            <div class="mb-3">
                <label class="form-labal">Seleziona linguaggi</label>

                <div>
                    @foreach ($technologies as $technology)
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="technologies[]" role="switch"
                                id="{{ $technology->id }}" value="{{ $technology->id }}"
                                {{ $project->technologies?->contains($technology) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $technology->id }}">{{ $technology->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Tipologia --}}
            <div class="mb-3">
                <label class="form-labal">Tipologia progetto</label>
                <select class="form-select" name="type_id">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $project->type_id === $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="mb-3">
                <label class="form-labal">Linguaggi usati</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="languages_used"
                    value="{{ old('languages_used', implode(', ', $project->languages_used)) }}">
                @error('languages_used')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div> --}}

            {{-- github link --}}
            <div class="mb-3">
                <label class="form-labal">Link GitHub del progetto</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="github_url"
                    value="{{ old('github_url', $project->github_url) }}">
                @error('github_url')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
    </div>
@endsection

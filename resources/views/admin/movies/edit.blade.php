@extends('admin.home')

@section('title', 'Create New')

@section('content')
    <div class="w-60">
        @session('message')
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endsession
        <form action="{{ route('admin.update', $movie->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="">Genre</label>
                <select name="genre_id" class="form-select">
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" @selected($genre->id === $movie->id)>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="">Title</label>
                <input type="text" name="title" value="{{ old('title') ?? $movie->title }}" class="form-control">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Poster</label>
                <input type="file" name="image" class="form-control">
                <img src="{{ Storage::url($movie->poster) }}" alt="" width="100">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Intro</label>
                <input type="text" name="intro" value="{{ old('intro') ?? $movie->intro }}" class="form-control">
                @error('intro')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Release_date</label>
                <input type="date" name="release_date" value="{{ old('release_date') ?? $movie->release_date }}"
                    class="form-control">
                @error('release_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <a href="{{ route('admin.movies') }}" class="btn btn-outline-primary">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

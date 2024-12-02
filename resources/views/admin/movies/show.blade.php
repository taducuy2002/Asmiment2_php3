@extends('admin.home')

@section('content')
<div class="container">
    <h1>Movie Details</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $movie->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Genre:</strong> {{ $movie->genre->name }}</p>
            <p><strong>Introduction:</strong> {{ $movie->intro }}</p>
            <p><strong>Release Date:</strong> {{ $movie->release_date }}</p>

            @if($movie->poster)
                <p><strong>Poster:</strong></p>
                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" style="max-width: 300px;">
            @else
                <p><em>No poster available</em></p>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.movies') }}" class="btn btn-primary">Back to Movies List</a>
            <a href="{{ route('admin.edit', $movie->id) }}" class="btn btn-warning">Edit Movie</a>
            <form action="{{ route('admin.destroy', $movie->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete Movie</button>
            </form>
        </div>
    </div>
</div>
@endsection

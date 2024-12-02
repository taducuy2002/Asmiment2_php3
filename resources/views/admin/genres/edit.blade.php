@extends('admin.home')

@section('title', 'Create New')

@section('content')
    <div class="w-60">
        @session('message')
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endsession
        <form action="{{ route('genres.update', $genre->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ old('name') ?? $genre->name }}" class="form-control">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <a href="{{ route('genres.list') }}" class="btn btn-outline-primary">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

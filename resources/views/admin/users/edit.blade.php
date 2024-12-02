@extends('admin.home')

@section('title', 'Create New')

@section('content')
    <div class="w-60">
        @session('message')
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endsession
        <form action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ old('name') ?? $user->name }}" class="form-control">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" name="email" value="{{ old('email') ?? $user->email }}" class="form-control">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Role</label>
                <select name="role" class="form-select">
                        <option value="user" @selected($user->role === 'user')>User</option>
                        <option value="admin" @selected($user->role === 'admin')>Admin</option>
                </select>
                @error('role')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <a href="{{ route('users.list') }}" class="btn btn-outline-primary">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

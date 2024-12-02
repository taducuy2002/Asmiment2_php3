@extends('admin.home')

@section('title', 'Create New')

@section('content')
    <div class="w-60">
        @session('message')
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endsession
        <form action="" method="post">
            @csrf
            <div class="mb-3">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ old('name')}}" class="form-control">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Role</label>
                <select name="role" class="form-select">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <a href="{{ route('users.list') }}" class="btn btn-outline-success">Back</a>
                <button type="submit" class="btn btn-success">Create New</button>
            </div>
        </form>
    </div>
@endsection

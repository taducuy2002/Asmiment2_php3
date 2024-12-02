@extends('admin.home')

@section('title', 'Danh sách')

@section('content')
    @session('message')
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endsession
    <div>
        <a href="{{ route('users.create') }}" class="btn btn-success my-3">Create New +</a>

        <table class="table table-bordered text-center table-hover">
            <thead class="table-success">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role == 'admin')
                                <span class="badge text-bg-success">Admin</span>
                            @else
                                <span class="badge text-bg-primary">User</span>
                            @endif
                        </td>
                        <td class="d-flex">
                            {{-- <a href="{{ route('users.show', $user->id) }}" class="btn btn-info" title="Detail"><i class="bi bi-eye-fill"></i></a> --}}
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning mx-1" title="Edit"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection

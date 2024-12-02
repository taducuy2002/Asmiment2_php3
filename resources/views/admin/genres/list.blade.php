@extends('admin.home')

@section('title', 'Danh sách')

@section('content')
    @session('message')
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endsession
    <div>
        <a href="{{ route('genres.create') }}" class="btn btn-success my-3">Create New +</a>

        <table class="table table-bordered text-center table-hover">
            <thead class="table-primary">
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody class="">
                @foreach ($genres as $genre)
                    <tr>
                        <td>{{ $genre->id }}</td>
                        <td>{{ $genre->name }}</td>
                        <td class="d-flex">
                            {{-- <a href="{{ route('genres.show', $genre->id) }}" class="btn btn-info" title="Detail"><i class="bi bi-eye-fill"></i></a> --}}
                            <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning mx-1" title="Edit"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('genres.destroy', $genre->id) }}" method="post">
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
        {{ $genres->links() }}
    </div>
@endsection

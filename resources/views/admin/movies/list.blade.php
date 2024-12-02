@extends('admin.home')

@section('title', 'Danh sách phim')

@section('content')
    @session('message')
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endsession
    <div>
        <a href="{{ route('admin.create') }}" class="btn btn-success my-3">Create New +</a>
        <a href="{{ route('admin.trash') }}" class="btn btn-warning" title="Trash"><i class="bi bi-trash-fill"></i></a>

        <table class="table table-bordered text-center table-hover">
            <thead class="table-warning">
                <th>ID</th>
                <th>Title</th>
                <th>Poster</th>
                <th>Intro</th>
                <th>Release_date</th>
                <th>Genre</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movie->id }}</td>
                        <td>{{ $movie->title }}</td>
                        <td>
                            <img src="{{Storage::url($movie->poster)}}" alt="Ảnh lỗi" width="100" style="object-fit: contain">
                        </td>
                        <td>{{ $movie->intro }}</td>
                        <td>{{ $movie->release_date }}</td>
                        <td>{{ $movie->genre->name }}</td>
                        <td class="d-flex">
                            <a href="{{ route('admin.show', $movie->id) }}" class="btn btn-info" title="Detail">Chi tiết</a>
                            <a href="{{ route('admin.edit', $movie->id) }}" class="btn btn-warning mx-1" title="Edit">Sửa</a>
                            <form action="{{ route('admin.destroy', $movie->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $movies->links() }}
    </div>
@endsection

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::query()->latest('id')->paginate(5);

        return view('admin.movies.list', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();

        return view('admin.movies.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
    {
        $data = $request->except('image');

        // upload ảnh
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images');
            $data['poster'] = $path_image;
        }


        Movie::query()->create($data);

        return redirect()->route('admin.movies')->with('message', 'Thêm phim thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genres = Genre::all();

        $movie = Movie::query()->find($id);

        return view('admin.movies.show', compact('genres', 'movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genres = Genre::all();

        $movie = Movie::query()->find($id);

        return view('admin.movies.edit', compact('genres', 'movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = Movie::query()->find($id);

        $data = $request->validate(
            [
                'title' => 'required|unique:movies,title,' . $movie->id . '|max:255', 
                // 'title' => 'required|unique:movies,title|max:255',
                'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
                'intro' => 'required|max:255',
                'release_date' => 'required|date|after_or_equal:today',
                'genre_id' => 'required|exists:genres,id'
            ],
            [
                'title.required' => 'Tiêu đề phim không được để trống.',
                'title.unique' => 'Tiêu đề phim đã tồn tại.',
                'image.image' => 'Poster phải là một file ảnh.',
                'image.max' => 'Dung lượng file không được vượt quá 2MB.',
                'intro.required' => 'Giới thiệu phim không được để trống.',
                'release_date.required' => 'Ngày công chiếu không được để trống.',
                'release_date.after_or_equal' => 'Ngày công chiếu phải từ hôm nay trở đi.',
                'genre_id.required' => 'Thể loại phim là bắt buộc.',
                'genre_id.exists' => 'Thể loại phim không hợp lệ.',
            ]
        );

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Xóa poster cũ nếu có
            if ($movie->poster) {
                Storage::disk('public')->delete($movie->poster);
            }
            // Lưu ảnh poster mới
            $data['poster'] = $request->file('image')->store('images');
        } else {
            // Nếu không có ảnh mới, giữ nguyên ảnh cũ
            $data['poster'] = $movie->poster;
        }

        $movie->update($data);

        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Movie::query()->find($id)->delete();

        return redirect()->route('admin.home')->with('message', 'Xóa dữ liệu thành công');
    }

    public function trash()
    {
        $movies = Movie::onlyTrashed()->paginate(10);

        return view('admin.movies.index', compact('movies'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $movies = Movie::where('title', 'like', '%' . $query . '%')->with('genre')->paginate(5);

        return view('admin.movies.index', compact('movies'));
    }
}

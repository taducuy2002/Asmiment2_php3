<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::query()->latest('id')->paginate(5);

        return view('admin.genres.list', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $genres = Genre::all();

        return view('admin.genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        $data = $request->all();
        Genre::query()->create($data);

        return redirect()->route('genres.list')->with('message', 'Thêm thể loại phim thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genre = Genre::query()->find($id);

        return view('admin.genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $genre = Genre::query()->find($id);

        $data = $request->validate(
            [
                'name' => 'required|unique:genres,name,' . $genre->id . '|max:255', 
            ],
            [
                'name.required' => 'Thể loại phim không được để trống.',
                'name.unique' => 'Thể loại phim đã tồn tại.',
            ]
        );

        $genre->update($data);

        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Genre::query()->find($id)->delete();

        return redirect()->route('genres.list')->with('message', 'Xóa dữ liệu thành công');
    }

}
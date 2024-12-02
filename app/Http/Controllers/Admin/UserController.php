<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->latest('id')->paginate(5);

        return view('admin.users.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $users = Genre::all();

        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => ['required', 'min:5', 'unique:users,name'],
                'email' => ['required', 'email', 'unique:users,email'],
                'role' => ['required',],
            ],
            [
                'name.required' => 'name là trường bắt buộc.',
                'name.min' => 'name phải có ít nhất :min ký tự.',
                'name.unique' => 'name đã tồn tại trong hệ thống.',

                'email.required' => 'email là trường bắt buộc.',
                'email.email' => 'email phải là một địa chỉ email hợp lệ.',
                'email.unique' => 'email đã tồn tại trong hệ thống.',

                'role.required' => 'email là trường bắt buộc.',
            ]
        );
        User::query()->create($data);

        return redirect()->route('users.list')->with('message', 'Thêm user phim thành công!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::query()->find($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::query()->find($id);

        $data = $request->validate(
            [
                'name' => 'required|unique:users,name,' . $user->id . '|max:255',
                'email' => ['required', 'email', 'unique:users,email,' . $user->id],
                'role' => ['required',],
            ],
            [
                'name.required' => 'name là trường bắt buộc.',
                'name.min' => 'name phải có ít nhất :min ký tự.',
                'name.unique' => 'name đã tồn tại trong hệ thống.',

                'email.required' => 'email là trường bắt buộc.',
                'email.email' => 'email phải là một địa chỉ email hợp lệ.',
                'email.unique' => 'email đã tồn tại trong hệ thống.',

                'role.required' => 'email là trường bắt buộc.',
            ]
        );

        $user->update($data);

        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::query()->find($id)->delete();

        return redirect()->route('users.list')->with('message', 'Xóa dữ liệu thành công');
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:movies,title|max:255', 
            'poster' => 'nullable|image|max:2048', 
            'intro' => 'required|max:255', 
            'release_date' => 'required|date|after_or_equal:today',
            'genre_id' => 'required|exists:genres,id', 
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề phim không được để trống.',
            'title.unique' => 'Tiêu đề phim đã tồn tại.',
            'poster.image' => 'Poster phải là một file ảnh.',
            'poster.max' => 'Dung lượng file không được vượt quá 2MB.',
            'intro.required' => 'Giới thiệu phim không được để trống.',
            'release_date.required' => 'Ngày công chiếu không được để trống.',
            'release_date.after_or_equal' => 'Ngày công chiếu phải từ hôm nay trở đi.',
            'genre_id.required' => 'Thể loại phim là bắt buộc.',
            'genre_id.exists' => 'Thể loại phim không hợp lệ.',
        ];
    }
}

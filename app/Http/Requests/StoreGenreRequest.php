<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenreRequest extends FormRequest
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
            'name' => 'required|unique:genres,name|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tiêu đề phim không được để trống.',
            'name.unique' => 'Tiêu đề phim đã tồn tại.',
        ];
    }
}

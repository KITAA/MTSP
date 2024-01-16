<?php

namespace App\Http\Requests\Berita;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeritaRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ];
    }


    public function messages(): array
    {
        return [
            'image.required' => 'Sila muat naik imej',
            'name.required' => 'Sila isi nama berita',
            'description.required' => 'Sila isi penerangan berita',
            'image.image' => 'Fail yang dimuat naik perlu berbentuk imej (jpeg, png, jpg, gif)',
            'image.mimes' => 'Format imej tidak sah. Sila gunakan format jpeg, png, jpg, gif',
            'image.max' => 'Saiz imej mesti kurang daripada 2048KB',
        ];
    }
}

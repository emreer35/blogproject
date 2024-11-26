<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            'file' => 'required|mimes:png,jpg,svg,jpeg',
            'category_id' => 'required',
            'title' => 'required|min:10|string',
            'content' => 'required|string|min:100'
        ];
    }
    public function messages()
    {
        return [
            'file.required' => 'Resim alanı gereklidir.',
            'file.mimes' => 'Dosya yalnızca png, jpg, svg veya jpeg formatında olmalıdır.',
            'category_id.required' => 'Kategori alanı gereklidir.',
            'title.required' => 'Başlık alanı gereklidir.',
            'title.min' => 'Başlık en az 10 karakter olmalıdır.',
            'content.required' => 'İçerik alanı gereklidir.',
            'content.min' => 'İçerik en az 100 karakter olmalıdır.',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookingFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $imageConfig = config('travelsetting.default.image');
        return [
            'page_title' => 'required|string',
            'banner_image' => 'required|image|mimes:png,jpg,jpeg,svg|max:1024',
            'image' => 'nullable|image|mimes:' . $imageConfig['mime_types'] . '|max:' . $imageConfig['max_size'],
            'content_title' => 'nullable|string',
            'description' => 'required|string',
        ];
    }
}

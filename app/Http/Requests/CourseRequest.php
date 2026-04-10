<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
{
    return [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'status' => 'required|in:published,draft',
        'description' => 'nullable|string', // THÊM DÒNG NÀY VÀO ĐÂY
        'image' => 'nullable|image|max:2048',
    ];
}
}
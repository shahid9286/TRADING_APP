<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }
    public function rules(): array
    {
        return [
            'hero_image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title' => 'required|array',
            'slug' => 'required|unique:pages,slug|max:255',
            'status' => 'required|in:draft,published',
            'type' => 'required|in:amer-service,visa,ded,real-estate',
            'route_name' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'order_no' => 'nullable|integer',
            'page_link_for' => 'nullable|string',
        ];
    }
}
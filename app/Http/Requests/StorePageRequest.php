<?php
// app/Http/Requests/StorePageRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'hero_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|array',
            'title.en' => 'required|string|max:255',
            'title.ar' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'description' => 'nullable|string',
            'hero_title' => 'nullable|array',
            'hero_sub_title' => 'nullable|array',
            'hero_description' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'type' => 'required|in:amer-service,visa,ded,real-estate',
            'route_name' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'order_no' => 'nullable|integer',
            'page_link_for' => 'nullable|in:none,header,footer,services',
            'meta_tags' => 'nullable|string',
        ];
    }
}
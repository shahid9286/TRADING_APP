<?php




// app/Services/PageService.php
namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class PageService
{
    public function handleImageUpload(UploadedFile $file): string
    {
        $imageName = time() . rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/admin/img'), $imageName);
        return $imageName;
    }

    public function storePageData(array $data): Page
    {
        $page = new Page();
        $page->slug = Str::slug($data['slug']);
        $page->setTranslations('title', $data['title']);
        $page->setTranslations('description', $data['description']);
        $page->setTranslations('hero_title', $data['hero_title']);
        $page->setTranslations('hero_sub_title', $data['hero_sub_title']);
        $page->hero_description = $data['hero_description'] ?? null;
        $page->status = $data['status'];
        $page->type = $data['type'];
        $page->route_name = $data['route_name'];
        $page->meta_title = $data['meta_title'];
        $page->meta_description = $data['meta_description'];
        $page->meta_keywords = $data['meta_keywords'];
        $page->order_no = $data['order_no'] ?? 0;
        $page->page_link_for = $data['page_link_for'] ?? 'none';
        $page->save();
        return $page;
    }
}
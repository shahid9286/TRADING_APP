<?php
namespace App\Http\Helpers;

use Illuminate\Support\Str;

class FileHelper
{
    public static function upload($file, $path)
    {
        $fileName = time(). '-'. Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $fileName);
        return $path . '/' . $fileName;
    }

    public static function delete($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }

    public static function get($file, $path)
    {
        return asset($path . '/' . $file);
    }
}
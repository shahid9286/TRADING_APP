<?php
namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class FileHelper
{
    public static function upload(UploadedFile $file, string $path): string
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $destination = public_path($path);
        
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);

        return $path . '/' . $filename;
    }

    public static function delete(string $relativePath): bool
    {
        $fullPath = public_path($relativePath);
        if (file_exists($fullPath)) {
            return unlink($fullPath);
        }
        return false;
    }

    public static function update(?string $oldPath, UploadedFile $newFile, string $uploadPath): string
    {
        if ($oldPath) {
            self::delete($oldPath);
        }
        return self::upload($newFile, $uploadPath);
    }
}

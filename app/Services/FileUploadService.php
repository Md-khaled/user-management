<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    public static function uploadFile($file)
    {
        $fileName = time() .'-'. Str::random(20) . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs(Image::STORAGE_PATH, $file, $fileName);
        return Image::STORAGE_PATH. '/' . $fileName;
    }
}
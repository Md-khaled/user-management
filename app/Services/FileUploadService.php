<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    private const STORAGE_PATH = 'uploads';

    public function uploadFile($file)
    {
        $fileName = time() .'-'. Str::random(20) . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs(self::STORAGE_PATH, $file, $fileName);
        return self::STORAGE_PATH. '/' . $fileName;
    }
}
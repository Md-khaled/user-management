<?php

namespace App\Services;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    private const STORAGE_TYPE = 'public';
    public static function uploadFile(UploadedFile $file, User $model)
    {
        $existingImage = $model->images()->first();
        if ($existingImage) {
            Storage::disk(self::STORAGE_TYPE)->delete($existingImage->url);
            $existingImage->delete();
        }

        $fileName = $file->hashName();
//        $fileName = time() .'-'. Str::random(20) . '.' . $file->getClientOriginalExtension();
        Storage::disk(self::STORAGE_TYPE)->putFileAs(Image::STORAGE_PATH, $file, $fileName);
        $model->images()->create(['url' => Image::STORAGE_PATH. '/' . $fileName]);

        return Image::STORAGE_PATH. '/' . $fileName;
    }
}

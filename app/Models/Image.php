<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    public const STORAGE_PATH = 'uploads';

    protected $fillable = [
        'url',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getFullUrlAttribute()
    {
        $imageUrl = Storage::url($this->path); 
        return url($imageUrl);
    }
}

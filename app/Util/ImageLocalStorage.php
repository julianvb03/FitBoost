<?php

namespace App\Util;

use App\Interfaces\ImageStorage;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageLocalStorage implements ImageStorage
{
    public function store(UploadedFile $image, string $directory): ?string
    {
        if (! $image->isValid()) {
            return null;
        }

        $filename = Str::random(40).'.'.$image->getClientOriginalExtension();

        try {
            Storage::disk('public')->makeDirectory($directory);

            if (Storage::disk('public')->putFileAs($directory, $image, $filename)) {
                return $directory.'/'.$filename;
            }

            return null;
        } catch (Exception $e) {
            return null;
        }
    }

    public function delete(string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        return Storage::disk('public')->delete($path);
    }
}

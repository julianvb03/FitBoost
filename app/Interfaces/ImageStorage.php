<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface ImageStorage
{
    public function store(UploadedFile $image, string $directory): ?string;

    public function delete(string $path): bool;
}

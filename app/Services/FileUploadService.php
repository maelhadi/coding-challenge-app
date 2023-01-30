<?php

namespace App\Services;

use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function uploadFile(UploadedFile $image): string
    {
        return Storage::disk('public')->put('images', $image);
    }
}

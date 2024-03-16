<?php

namespace App\Services\Storage;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function mkdir(?string $disk = 'public', ?string $dir = null): string
    {
        $dirname = $dir ?? $this->generateName();
        Storage::disk($disk)->makeDirectory($dirname);
        $root = config('filesystems.disks.' . $disk . '.root');

        return $root . '/' . $dirname;
    }

    public function generateName(?string $value = null): string
    {
        return $value ?? md5(random_bytes(3));
    }
}

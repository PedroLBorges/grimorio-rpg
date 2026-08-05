<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CharacterPhotoService
{
    public function store(UploadedFile $photo): string
    {
        return $photo->store('character-photos', 'public');
    }

    public function delete(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    public function deleteMany(iterable $paths): void
    {
        foreach ($paths as $path) {
            $this->delete($path);
        }
    }

    public function exists(?string $path): bool
    {
        return $path !== null && Storage::disk('public')->exists($path);
    }
}

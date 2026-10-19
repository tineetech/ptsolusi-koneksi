<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait UploadsImages
{
    /**
     * Store an uploaded image inside public/images/{$folder} and return its
     * relative path so it can be resolved with the asset() helper.
     */
    protected function storeImage(UploadedFile $file, string $folder, ?string $oldPath = null): string
    {
        $directory = public_path('images/'.$folder);

        if (! is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        if ($oldPath && str_starts_with($oldPath, 'images/'.$folder.'/')) {
            $oldFile = public_path($oldPath);

            if (is_file($oldFile)) {
                @unlink($oldFile);
            }
        }

        $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'gambar';
        $filename = $name.'-'.uniqid().'.'.strtolower($file->getClientOriginalExtension());

        $file->move($directory, $filename);

        return 'images/'.$folder.'/'.$filename;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaController
{
    public function destroy(Media $media)
    {
        Storage::delete($media->file_path);
        $media->delete();
        return back();
    }
}
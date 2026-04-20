<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;

class MediaController extends Controller
{
    public function destroy(Media $media)
    {
        $media->delete();

        return back()->with('success', 'Media berhasil dihapus');
    }
}
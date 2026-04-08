<?php

namespace App\Http\Controllers;

use App\Models\Media;

class MediaController extends Controller
{
    public function destroy(Media $media)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $media->delete();
        return back();
    }
}
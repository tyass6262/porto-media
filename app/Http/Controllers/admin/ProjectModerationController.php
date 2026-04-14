<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectModerationController extends Controller
{
    // ✅ Lihat semua project user
    public function index()
    {
        $projects = Project::with(['user', 'categories', 'media'])
            ->latest()
            ->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function destroy(Project $project)
    {
        foreach ($project->media as $media) {
            $media->delete();
        }

        $project->delete();

        return back()->with('success', 'Project berhasil dihapus (moderasi)');
    }
}
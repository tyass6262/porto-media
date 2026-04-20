<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectModerationController extends Controller
{
    public function index()
    {
        $projects = Project::with(['user','media','categories'])
            ->latest()
            ->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::with(['user','media','categories'])
            ->findOrFail($id);

        return view('admin.projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        foreach ($project->media as $media) {
            if ($media->file_path && Storage::disk('public')->exists($media->file_path)) {
                Storage::disk('public')->delete($media->file_path);
            }
        }

        $project->categories()->detach();
        $project->media()->delete();

        $project->delete();

        return back()->with('success', 'Project & semua media berhasil dihapus');
    }
}
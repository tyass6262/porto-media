<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('user', 'categories', 'media')->latest()->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $project->load('user', 'categories', 'media');

        return view('admin.projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('success', 'Project berhasil dihapus oleh admin');
    }
}
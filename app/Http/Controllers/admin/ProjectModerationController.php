<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectModerationController extends Controller
{
    public function index()
    {
        $projects = Project::with(['user', 'categories', 'media'])
            ->latest()
            ->paginate(9);

        return view('admin.projects.index', compact('projects'));
    }
}
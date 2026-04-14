<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\Media;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $projectCount = Project::count();
        $categoryCount = Category::count();
        $mediaCount = Media::count();

        // ✅ FIX DI SINI (categories)
        $projects = Project::with(['user', 'categories', 'media'])
                    ->latest()
                    ->take(10)
                    ->get();

        return view('admin.dashboard', compact(
            'userCount',
            'projectCount',
            'categoryCount',
            'mediaCount',
            'projects'
        ));
    }
}
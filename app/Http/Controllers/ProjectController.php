<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('media', 'categories')
            ->where('status', 'published');

        if ($request->category) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        $projects = $query->latest()->get();
        $categories = Category::where('is_active', true)->get();

        return view('projects.index', compact('projects', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'categories' => 'required|array',
            'media.*' => 'file|mimes:jpg,png,mp4,pdf|max:2048',
            'embed_url.*' => 'nullable|url'
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => auth()->id()
        ]);

        $project->categories()->sync($request->categories);

        // upload file
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('media', 'public');

                Media::create([
                    'project_id' => $project->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        // embed
        if ($request->embed_url) {
            foreach ($request->embed_url as $url) {
                if ($url) {
                    Media::create([
                        'project_id' => $project->id,
                        'file_path' => $url,
                        'file_type' => 'embed',
                        'file_name' => 'embed',
                        'file_size' => 0,
                    ]);
                }
            }
        }

        return redirect('/projects');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back();
    }
}
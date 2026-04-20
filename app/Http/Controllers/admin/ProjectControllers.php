<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['categories','media'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('user.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'categories' => 'required|array',
            'media.*' => 'nullable|file|max:20480',
            'embed_urls.*' => 'nullable|url',
            'status' => 'required|in:draft,published'
        ]);

        $project = Project::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        $project->categories()->sync($request->categories);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {

                $path = $file->store('media', 'public');
                $type = $this->detectType($file->getClientOriginalExtension());

                Media::create([
                    'project_id' => $project->id,
                    'file_path' => $path,
                    'file_type' => $type,
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize()
                ]);
            }
        }

        if ($request->embed_urls) {
            foreach ($request->embed_urls as $url) {
                if ($url) {
                    Media::create([
                        'project_id' => $project->id,
                        'embed_url' => $url,
                        'file_type' => 'embed'
                    ]);
                }
            }
        }

        return redirect()->route('user.projects.index')
            ->with('success','Project berhasil dibuat');
    }

    public function show($id)
    {
        $project = Project::with(['categories','media'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('user.projects.show', compact('project'));
    }

    public function destroy($id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);
        $project->delete();

        return back()->with('success','Project berhasil dihapus');
    }

    private function detectType($ext)
    {
        $ext = strtolower($ext);

        if (in_array($ext, ['jpg','jpeg','png','gif'])) return 'image';
        if (in_array($ext, ['mp4','mov','avi'])) return 'video';

        return 'file';
    }
}
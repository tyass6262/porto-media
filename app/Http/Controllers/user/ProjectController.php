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
    /* =========================
       USER PROJECT (PRIVATE)
    ========================= */

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

        $this->handleMediaUpload($request, $project);

        return redirect()->route('user.projects.index')
            ->with('success','Project berhasil dibuat');
    }

    public function show($id)
    {
        $project = Project::with(['categories','media','user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);
        $categories = Category::where('is_active', true)->get();

        return view('user.projects.edit', compact('project','categories'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'categories' => 'required|array',
            'media.*' => 'nullable|file|max:20480',
            'embed_urls.*' => 'nullable|url',
            'status' => 'required|in:draft,published'
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        $project->categories()->sync($request->categories);

        // tambah media baru
        $this->handleMediaUpload($request, $project);

        return redirect()->route('user.projects.index')
            ->with('success','Project berhasil diupdate');
    }

    public function destroy($id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);

        $project->delete();

        return back()->with('success','Project berhasil dihapus');
    }

    /* =========================
       PUBLIC PORTFOLIO
    ========================= */

    public function publicIndex()
    {
        $projects = Project::with(['categories','media','user'])
            ->where('status','published')
            ->latest()
            ->get();

        $categories = Category::where('is_active', true)->get();

        return view('portfolio.index', compact('projects','categories'));
    }

    public function publicShow($id)
    {
        $project = Project::with(['categories','media','user'])
            ->where('id', $id)
            ->where('status','published')
            ->firstOrFail();

        return view('portfolio.show', compact('project'));
    }

    public function filterByCategory($slug)
    {
        $projects = Project::whereHas('categories', function($q) use ($slug){
                $q->where('slug', $slug);
            })
            ->where('status','published')
            ->with(['categories','media','user'])
            ->latest()
            ->get();

        $categories = Category::where('is_active', true)->get();

        return view('portfolio.index', compact('projects','categories'));
    }

    /* =========================
       HELPER
    ========================= */

    private function handleMediaUpload($request, $project)
    {
        // file upload
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {

                $path = $file->store('media', 'public');
                $type = $this->detectType($file->getClientOriginalExtension());

                Media::create([
                    'project_id' => $project->id,
                    'file_path' => $path,
                    'type' => $type
                ]);
            }
        }

        // embed URL
        if ($request->embed_urls) {
            foreach ($request->embed_urls as $url) {
                if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
                    Media::create([
                        'project_id' => $project->id,
                        'embed_url' => $url,
                        'type' => 'embed'
                    ]);
                }
            }
        }
    }

    private function detectType($ext)
    {
        $ext = strtolower($ext);

        if (in_array($ext, ['jpg','jpeg','png','gif'])) return 'image';
        if (in_array($ext, ['mp4','mov','avi'])) return 'video';

        return 'file';
    }
}
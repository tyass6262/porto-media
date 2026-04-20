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

    /*
    |--------------------------------------------------------------------------
    | 🔥 TOGGLE STATUS (Publish / Draft)
    |--------------------------------------------------------------------------
    */
    public function toggleStatus($id)
    {
        $project = Project::where('user_id', Auth::id())->findOrFail($id);

        $project->status = $project->status === 'published' ? 'draft' : 'published';
        $project->save();

        return back()->with('success', 'Status project berhasil diubah');
    }

    /*
    |--------------------------------------------------------------------------
    | 🌐 PUBLIC VIEW
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | 📦 HANDLE MEDIA
    |--------------------------------------------------------------------------
    */
    private function handleMediaUpload($request, $project)
    {
        // UPLOAD FILE
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {

                $path = $file->store('media', 'public');
                $type = $this->detectType($file->getClientOriginalExtension());

                Media::create([
                    'project_id' => $project->id,
                    'file_path' => $path,
                    'file_type' => $type
                ]);
            }
        }

        // EMBED URL
        if ($request->embed_urls) {
            foreach ($request->embed_urls as $url) {
                if ($url && filter_var($url, FILTER_VALIDATE_URL)) {

                    Media::create([
                        'project_id' => $project->id,
                        'embed_url' => $this->formatEmbedUrl($url),
                        'file_type' => 'embed'
                    ]);
                }
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | 🔥 FORMAT EMBED (AUTO SUPPORT MULTI PLATFORM)
    |--------------------------------------------------------------------------
    */
    private function formatEmbedUrl($url)
    {
        $url = trim($url);

        // YOUTUBE
        if (str_contains($url, 'youtube.com/watch?v=')) {
            return str_replace('watch?v=', 'embed/', strtok($url, '?'));
        }

        if (str_contains($url, 'youtu.be/')) {
            return 'https://www.youtube.com/embed/' . basename($url);
        }

        if (str_contains($url, 'youtube.com/shorts/')) {
            return str_replace('shorts/', 'embed/', strtok($url, '?'));
        }

        // GOOGLE DRIVE
        if (str_contains($url, 'drive.google.com')) {
            if (preg_match('/\/d\/(.*?)\//', $url, $match)) {
                return "https://drive.google.com/file/d/".$match[1]."/preview";
            }
        }

        // DEFAULT
        return $url;
    }

    /*
    |--------------------------------------------------------------------------
    | 🔍 DETECT FILE TYPE
    |--------------------------------------------------------------------------
    */
    private function detectType($ext)
    {
        $ext = strtolower($ext);

        if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) return 'image';
        if (in_array($ext, ['mp4','mov','avi','webm'])) return 'video';

        return 'file';
    }
}
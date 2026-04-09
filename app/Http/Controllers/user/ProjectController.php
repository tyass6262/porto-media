<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', auth()->id())
            ->with('categories')
            ->get();

        return view('user.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::where('is_active',1)->get();
        return view('user.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required'
        ]);

        $project = Project::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        if($request->categories){
            $project->categories()->sync($request->categories);
        }

        if($request->hasFile('media')){
            foreach($request->file('media') as $file){

                $path = $file->store('portfolio', 'public');

                Media::create([
                    'project_id' => $project->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientMimeType(),
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('user.projects.index');
    }

    public function show(Project $project)
    {
        return view('user.projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back();
    }
}
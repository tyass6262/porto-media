<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('categories','media')
            ->where('status','published');

        // FILTER
        if ($request->category) {
            $query->whereHas('categories', function($q) use ($request){
                $q->where('id',$request->category);
            });
        }

        return view('projects.index',[
            'projects'=>$query->latest()->get(),
            'categories'=>Category::where('is_active',1)->get()
        ]);
    }

    public function create()
    {
        return view('projects.create',[
            'categories'=>Category::where('is_active',1)->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'categories'=>'required|array',
            'media.*'=>'file|max:2048',
            'embed_url.*'=>'nullable|url'
        ]);

        $project = Project::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'user_id'=>auth()->id()
        ]);

        $project->categories()->sync($request->categories);

        // upload file
        if($request->hasFile('media')){
            foreach($request->file('media') as $file){
                $path = $file->store('portfolio','public');

                Media::create([
                    'project_id'=>$project->id,
                    'file_path'=>$path,
                    'file_type'=>$file->getClientMimeType()
                ]);
            }
        }

        // embed
        if($request->embed_url){
            foreach($request->embed_url as $url){
                if($url){
                    Media::create([
                        'project_id'=>$project->id,
                        'file_path'=>$url,
                        'file_type'=>'embed'
                    ]);
                }
            }
        }

        return redirect('/projects');
    }

    public function show(Project $project)
    {
        return view('projects.show',compact('project'));
    }

    public function destroy(Project $project)
    {
        if($project->user_id != auth()->id()) abort(403);

        $project->delete();

        return back();
    }
}
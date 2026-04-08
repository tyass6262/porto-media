<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index',[
            'categories'=>Category::withCount('projects')->get()
        ]);
    }

    public function store(Request $request)
    {
        Category::create([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'is_active'=>1
        ]);
        return back();
    }

    public function update(Request $request, Category $category)
    {
        $category->update([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'is_active'=>$request->is_active ? 1 : 0
        ]);
        return back();
    }

    public function destroy(Category $category)
    {
        if($category->projects()->count()>0){
            return back()->with('error','Kategori dipakai!');
        }

        $category->delete();
        return back();
    }
}
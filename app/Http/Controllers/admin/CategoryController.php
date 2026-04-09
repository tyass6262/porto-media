<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return back();
    }

    public function destroy(Category $category)
    {
        if($category->projects()->count() > 0){
            return back()->with('error','Kategori sedang dipakai');
        }

        $category->delete();
        return back();
    }
}
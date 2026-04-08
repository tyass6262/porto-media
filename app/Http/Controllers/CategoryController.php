<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return back();
    }

    public function destroy(Category $category)
    {
        if ($category->projects()->count() > 0) {
            return back()->with('error', 'Dipakai project!');
        }

        $category->delete();
        return back();
    }
}
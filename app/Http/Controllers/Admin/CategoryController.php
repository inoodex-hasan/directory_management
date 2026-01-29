<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:categories|max:255',
        ]);

        Category::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
        ]);

        return back()->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
{

    $category = Category::findOrFail($id);

    $request->validate([
        'title' => 'required|max:255|unique:categories,title,' . $id,
        'status' => 'required|boolean',
    ]);

    $category->update([
        'title'  => $request->title,
        'slug'   => Str::slug($request->title),
        'status' => $request->status,
    ]);

    return redirect()->route('admin.categories.index')
                     ->with('success', 'Category updated successfully!');
}

    public function show(Category $category)
    {
        $links = $category->links()->where('status', 'active')->paginate(15);
        
        return view('admin.categories.show', compact('category', 'links'));
    }
}

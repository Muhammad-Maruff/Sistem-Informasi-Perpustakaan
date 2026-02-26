<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        return view('category', ['categories' => $categories]);
    }

    public function add(){
        return view('category-add');
    }

    public function create(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);

        $category = Category::create($request->all());
        return redirect('categories')->with('status', 'Category Added Successfully !');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('category-edit', ['categories' => $category]);
    }

    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category->update($request->all());
        return redirect('categories')->with('status', 'Category Updated Successfully !');
    }

    public function delete($slug){
        $category = Category::where('slug', $slug)->first();
        return view('category-delete', ['category' => $category]);
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug);
        $category->delete();
        return redirect('categories')->with('status', 'Category Deleted Successfully !');
    }

    public function deletedCategory()
    {
        $categoryDeleted = Category::onlyTrashed()->get();
        return view('category-deleted-list', ['categoryDeleted' => $categoryDeleted ]);
    }

    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $category->restore();
        return redirect('categories')->with('status', 'Category Restored Successfully !');
    }
}

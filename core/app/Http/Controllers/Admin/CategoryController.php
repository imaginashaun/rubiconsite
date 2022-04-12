<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $page_title = "Category List";
        $empty_message = "Category Not Found";
        $categorys = Category::latest()->paginate(getPaginate());
        return view('admin.category.index', compact('categorys', 'page_title', 'empty_message'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:191'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        $notify[] = ['success', 'Category Create Successfully'];
        return back()->withNotify($notify);
    }


    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:categories,id',
            'name' => 'required|max:191|unique:categories,name,'.$request->id,
        ]);
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->update();
        $notify[] = ['success', 'Category Update Successfully'];
        return redirect()->route('admin.category.index')->withNotify($notify);
    }
}

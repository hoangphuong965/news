<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function show()
    {
        $categories = Category::orderBy('category_order', 'asc')->get();
        return view('admin.category_show', compact('categories'));
    }

    public function create()
    {
        return view('admin.category_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'category_order' => 'required'
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->show_on_menu = $request->show_on_menu;
        $category->category_order = $request->category_order;
        $category->save();

        return redirect()->route('admin_category_show')->with('success', 'Category' .$request->category_name. ' thêm thành công');
    }

    public function edit($id)
    {   
        $category = Category::findOrFail($id);
        return view('admin.category_edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
            'category_order' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->show_on_menu = $request->show_on_menu;
        $category->category_order = $request->category_order;
        $category->update();
        return redirect()->route('admin_category_show')->with('success', 'Category ' .$request->category_name. ' cập nhật thành công');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin_category_show')->with('success', 'Category ' .$category->category_name. ' đã xoá thành công');
    }
}

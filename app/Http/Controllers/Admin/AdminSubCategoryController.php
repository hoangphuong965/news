<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class AdminSubCategoryController extends Controller
{
    public function show()
    {
        $sub_categories = SubCategory::with('rCategory')->orderBy('sub_category_order', 'asc')->get();
        return view('admin.sub_category_show', compact('sub_categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('category_order','asc')->get();
        return view('admin.sub_category_create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_category_name' => 'required',
            'sub_category_order' => 'required'
        ]);

        $sub_category = new SubCategory();
        $sub_category->sub_category_name = $request->sub_category_name;
        $sub_category->show_on_menu = $request->show_on_menu;
        $sub_category->show_on_home = $request->show_on_home;
        $sub_category->sub_category_order = $request->sub_category_order;
        $sub_category->category_id = $request->category_id;
        $sub_category->save();

        return redirect()->route('admin_sub_category_show')->with('success', 'Subcategory được thêm vào thành công.');
    }

    public function edit($id)
    {
        $data = SubCategory::findOrFail($id);
        $categories = Category::orderBy('category_order','asc')->get();
        return view('admin.sub_category_edit',  compact('categories', 'data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sub_category_name' => 'required',
            'sub_category_order' => 'required'
        ]);

        $sub_category = SubCategory::findOrFail($id);

        $sub_category->sub_category_name = $request->sub_category_name;
        $sub_category->show_on_menu = $request->show_on_menu;
        $sub_category->show_on_home = $request->show_on_home;
        $sub_category->sub_category_order = $request->sub_category_order;
        $sub_category->category_id = $request->category_id;

        $sub_category->update();
        return redirect()->route('admin_sub_category_show')->with('success', 'Subcategory được cập nhật thành công.');
    }

    public function delete($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $sub_category->delete();
        return redirect()->route('admin_sub_category_show')->with('success', 'Subcategory xóa thành công.');
    }
}

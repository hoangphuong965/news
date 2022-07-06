<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $setting_data = Setting::where('id', 1)->first();
        $posts_data = Post::orderBy('id', 'desc')->get();

        // lastest new
        $latest_news_center = Post::get()->last();

        // subcategory
        $sub_category_data = SubCategory::with('rPost','rCategory')->orderBy('sub_category_order', 'asc')->where('show_on_home', 'Show')->get();
        $category_data = Category::with('rSubcategory')->where('show_on_menu', 'Show')->orderBy('category_order', 'asc')->get();


        return view('front.home', compact('setting_data', 'posts_data', 'latest_news_center', 'sub_category_data', 'category_data'));
    }

    public function get_subcategory_by_category($id)
    {
        $sub_category_data = SubCategory::where('category_id', $id)->get();
        $response = "<option value=''>Select SubCategory</option>";
        foreach ($sub_category_data as $item) {
            $response .= '<option value="'. $item->id .'">'. $item->sub_category_name .'</option>';
        }
        return response()->json(['sub_category_data' => $response]);
    }

    public function search(Request $request)
    {
        $posts_data = Post::orderBy('id', 'desc');

        if($request->text_item != '') {
            $posts_data = $posts_data->where('post_title', 'like', '%'.$request->text_item.'%');
        }

        if($request->sub_category!='') {
            $posts_data = $posts_data->where('sub_category_id', $request->sub_category);
        } else if ($request->category != '' && $request->sub_category =='') {
            $category_id = Category::where('id', $request->category)->get();
            $id = [];
            foreach ($category_id as $item) {
                $t = SubCategory::where('category_id', $item->id)->get();
                foreach ($t as $item) {
                    $id[] = $item->id;
                }
            }
            $posts_data = Post::orderBy('id', 'desc')->whereIn('sub_category_id', $id);
        }

        $posts_data = $posts_data->paginate(10);
        return view('front.search_result', compact('posts_data'));
    }
}

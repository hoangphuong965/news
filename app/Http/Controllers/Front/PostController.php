<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function detail($id)
    {
        $tag_data = Tag::where('post_id', $id)->get();
        $post_detail = Post::with('rSubCategory')->findOrFail($id);
        
        // update view count
        $post_detail->visitors = $post_detail->visitors + 1;
        $post_detail->update();

        $related_post_array = Post::with('rSubCategory')->orderBy('id','desc')->where('sub_category_id',$post_detail->sub_category_id)->get();
 
        return view('front.post_detail', compact('post_detail', 'tag_data', 'related_post_array'));
    }
}

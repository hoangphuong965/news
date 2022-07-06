<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($tag_name)
    {
        $all_tag = Tag::where('tag_name', $tag_name)->get();
        $all_posts_id = [];
        foreach ($all_tag as $item) {
            $all_posts_id[] = $item->post_id;
        }
        $all_posts = Post::orderBy('id', 'desc')->get(); 
        return view('front.tag', compact('all_posts_id', 'all_posts', 'tag_name'));
    }
}

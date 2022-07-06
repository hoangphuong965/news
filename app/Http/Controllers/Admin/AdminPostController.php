<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPostController extends Controller
{
    public function show()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.post_show', compact('posts'));
    }

    public function create()
    {
        $sub_categories = SubCategory::with('rCategory')->get();
        return view('admin.post_create', compact('sub_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_title' => 'required',
            'post_detail' => 'required',
            'post_photo' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        $q = DB::select("SHOW TABLE STATUS LIKE 'posts'");
        $ai_id = $q[0]->Auto_increment;

        $now = time();
        $ext = $request->file('post_photo')->extension();
        $final_name = 'post_photo_'.$now.'.'.$ext;
        $request->file('post_photo')->move(public_path('uploads/'),$final_name);

        $post = new Post();
        $post->sub_category_id = $request->sub_category_id;
        $post->post_title = $request->post_title;
        $post->post_detail = $request->post_detail;
        $post->post_photo = $final_name;
        $post->visitors = 1;
        $post->author_id = 0;
        $post->admin_id = Auth::guard('admin')->user()->id;
        $post->save();

        if($request->tags != '') {
            $tags_array_new = [];
            $tags_array = explode(',',$request->tags);
            for($i=0; $i<count($tags_array); $i++)
            {
                $tags_array_new[] = trim($tags_array[$i]);
            }
            
            $tags_array_new = array_values(array_unique($tags_array_new));
            if(end($tags_array_new) == "") {
                array_pop($tags_array_new);
            }
            for($i=0;$i<count($tags_array_new);$i++)
            {
                $tag = new Tag();
                $tag->post_id = $ai_id;
                $tag->tag_name = trim($tags_array_new[$i]);
                $tag->save();
            }
        }
        return redirect()->route('admin_post_show')->with('success', 'Posts được thêm vào thành công.');
    }


    public function edit($id)
    {   
        $post_single = Post::findOrFail($id);
        $sub_categories = SubCategory::get();
        $existing_tags = Tag::where('post_id', $id)->get();
        return view('admin.post_edit', compact('post_single', 'sub_categories', 'existing_tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'post_title' => 'required',
            'post_detail' => 'required'
        ]);

        $post = Post::where('id',$id)->first();

        if($request->hasFile('post_photo')) {
            $request->validate([
                'post_photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            unlink(public_path('uploads/'.$post->post_photo));

            $now = time();
            $ext = $request->file('post_photo')->extension();
            $final_name = 'post_photo_'.$now.'.'.$ext;
            $request->file('post_photo')->move(public_path('uploads/'),$final_name);

            $post->post_photo = $final_name;
        }
        
        $post->sub_category_id = $request->sub_category_id;
        $post->post_title = $request->post_title;
        $post->post_detail = $request->post_detail;
        $post->update();

        if($request->tags != '') {
            $tags_array = explode(',',$request->tags);
            for($i=0;$i<count($tags_array);$i++)
            {
                $total = Tag::where('post_id',$id)->where('tag_name',trim($tags_array[$i]))->count();
                
                if(!$total) {
                    $tag = new Tag();
                    $tag->post_id = $id;
                    $tag->tag_name = trim($tags_array[$i]);
                    $tag->save();
                }
            }
        }        

        return redirect()->route('admin_post_show')->with('success', 'Posts được cập nhật thành công.');
    }

    public function delete_tag($id, $id1)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->route('admin_post_edit',$id1)->with('success', 'Tags xóa thành công.');
    }

    public function delete($id)
    {
        $post = Post::where('id',$id)->first();
        unlink(public_path('uploads/'.$post->post_photo));
        $post->delete();

        Tag::where('post_id',$id)->delete();

        return redirect()->route('admin_post_show')->with('success', 'Posts xóa thành công.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AdminAuthorController extends Controller
{
    public function show()
    {
        $authors = Author::get();
        return view('admin.author_show', compact('authors'));
    }

    public function create()
    {
        return view('admin.author_create');
    }

    public function store(Request $request)
    {
        $author = new Author();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:authors',
            'password' => 'required',
            'retype_password' => 'required|same:password'
        ]);

        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            $now = time();
            $ext = $request->file('photo')->extension();
            $final_name = 'author_photo_'.$now.'.'.$ext;
            $request->file('photo')->move(public_path('uploads/'),$final_name);
            $author->photo = $final_name;
        }
        
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = Hash::make($request->password);
        $author->token = '';
        $author->save();

        // Send email
        $subject = 'Tài khoản của bạn được tạo';
        $message = 'Xin chào, tài khoản của bạn được tạo thành công và bây giờ bạn có thể đăng nhập vào hệ thống. Vui lòng truy cập liên kết này: <br><br>';
        $message .= '<a href="'.route('login').'">';
        $message .= 'Nhấp vào liên kết này';
        $message .= '</a>';
        $message .= '<br><br>Vui lòng xem mật khẩu của bạn ở đây và sau khi đăng nhập, thay đổi ngay lập tức:<br>';
        $message .= $request->password;

        Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->route('admin_author_show')->with('success', 'Author account is created successfully.');
    }

    public function edit($id)
    {
        $author_data = Author::where('id',$id)->first();
        return view('admin.author_edit', compact('author_data'));
    }

    public function update(Request $request,$id) 
    {
        $author = Author::where('id',$id)->first();

        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('authors')->ignore($author->id)
            ]
        ]);

        if($request->password!='') {
            $request->validate([
                'password' => 'required',
                'retype_password' => 'required|same:password'
            ]);
            $author->password = Hash::make($request->password);
        }

        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            if(!$author->photo == "") {
                unlink(public_path('uploads/'.$author->photo));
            }

            $now = time();
            $ext = $request->file('photo')->extension();
            $final_name = 'author_photo_'.$now.'.'.$ext;
            $request->file('photo')->move(public_path('uploads/'),$final_name);
            $author->photo = $final_name;
        }
        
        $author->name = $request->name;
        $author->email = $request->email;
        $author->update();

        return redirect()->route('admin_author_show')->with('success', 'Author được cập nhật thành công.');
    }

    public function delete($id)
    {
        $author = Author::where('id',$id)->first();
        if($author->photo != NULL) {
            unlink(public_path('uploads/'.$author->photo));
        }
        $author->delete();

        return redirect()->route('admin_author_show')->with('success', 'Author xóa thành công.');

    }
}

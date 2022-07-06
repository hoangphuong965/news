<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function profile_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $admin = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        
        if ($request->password != '') {
            $request->validate([
                'password' => 'required|min:6',
                'retype_password' => 'required|same:password'
            ]);
            $admin->password = Hash::make($request->password);
        }

        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif',
            ]);

            if($admin->photo == "") {
                $ext = $request->file('photo')->extension();
                $name_file = date("dmyHis");
                $final_name = 'admin.'.''.$name_file.'.'.$ext;
                $request->file('photo')->move(public_path('uploads/'), $final_name);
            } else {
                unlink(public_path('uploads/'.$admin->photo));
                $ext = $request->file('photo')->extension();
                $name_file = date("dmyHis");
                $final_name = 'admin.'.''.$name_file.'.'.$ext;           
                $request->file('photo')->move(public_path('uploads/'), $final_name);
            }
            $admin->photo = $final_name;
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->update();

        return redirect()->route('admin_category_show')->with('success', 'Thông tin hồ sơ được lưu thành công');
    }
}

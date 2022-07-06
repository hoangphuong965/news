<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminLoginController extends Controller
{

    public function index()
    {  
        return view('admin.login');   
    }

    public function forget_password()
    {
        return view('admin.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if(!$admin) {
            return redirect()->back()->with('error', 'Email ' .$request->email. ' không tìm thấy');
        }

        $token = hash('sha256', time());
        $admin->token = $token;
        $admin->update();
        $reset_link = url("admin/reset-password/{$token}/{$request->email}");
        $subject = "Reset Password";
        $message = "Click on the link here: <br>";
        $message .= "<a href={$reset_link}>Click here</a>";

        Mail::to($request->email)->send(new Websitemail($subject, $message));
        return redirect()->route('admin_login')->with('success', 'Vui lòng kiểm tra email của bạn');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('admin')->attempt($credential)) {
            return redirect()->route('admin_home');
        } else {
            return redirect()->route('admin_login')->with('error', 'Email ' .$request->email. ' không tìm thấy');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }

    public function reset_password($token, $email)
    {
        $admin = Admin::where('token', $token)->where('email', $email)->first();
        if(!$admin) {
            return redirect()->route('admin_login');
        }
        return view('admin.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
            'retype_password' => 'required|same:password'
        ]);

        $admin = Admin::where('token', $request->token)->where('email', $request->email)->first();
        $admin->password = Hash::make($request->password);
        $admin->token = '';
        $admin->update();

        return redirect()->route('admin_login')->with('success', 'Password được thay đổi lại thành công');
    }
}

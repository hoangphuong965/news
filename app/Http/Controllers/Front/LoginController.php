<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Author;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        $login_data = Page::where('id', 1)->first();
        return view('front.login', compact('login_data'));
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],[
            'email.required' => "Email là bắt buộc",
            'email.email' => "Email không đúng",
            'password.required' => "Password là bắt buộc",
            'password.min' => "Password phải có ít nhất 6 ký tự.",
        ]);
        
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('author')->attempt($credential)) {
            return redirect()->route('author_home');
        } else {
            return redirect()->route('login')->with('error', 'Email ' .$request->email. ' không tìm thấy');
        }
    }

    public function logout()
    {
        Auth::guard('author')->logout();
        return redirect()->route('login');
    }

    public function forget_password()
    {
        $forget_password_title = "Forget Password";
        return view('front.forget_password', compact('forget_password_title'));
    }

    public function forget_password_submit(Request $request)
    {

        $request->validate([
            'email' => 'required|email'
        ],[
            'email.required' => "Email là bắt buộc",
            'email.email' => "Email không đúng"
        ]);

        $author_data = Author::where('email',$request->email)->first();
        if(!$author_data) {
            return redirect()->back()->with('error', "Email không tìm thấy");
        }

        $token = hash('sha256',time());
        $author_data->token = $token;
        $author_data->update();

        $reset_link = url('reset-password/'.$token.'/'.$request->email);
        $subject = 'Reset Password';
        $message = 'Vui lòng nhấp vào liên kết sau: <br>';
        $message .= '<a href="'.$reset_link.'">Click here</a>';

        Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->route('login')->with('success', "Hãy kiểm tra email của bạn");

    }

    public function reset_password($token, $email)
    {
        $author_data = Author::where('token',$token)->where('email',$email)->first();
        if(!$author_data) {
            return redirect()->route('login');
        }

        return view('front.reset_password', compact('token','email'));
    }

    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
            'retype_password' => 'required|same:password',
        ],[
            'password.required' => "Password là bắt buộc",
            'password.min' => "Password phải có ít nhất 6 ký tự",
            'retype_password.required' => "Nhập lại password là bắt buộc",
            'retype_password.same' => "Password phải giống retype password",
        ]);

        $author_data = Author::where('token',$request->token)->where('email',$request->email)->first();

        $author_data->password = Hash::make($request->password);
        $author_data->token = '';
        $author_data->update();

        return redirect()->route('login')->with('success', "Reset mật khẩu thành công");

    }
}

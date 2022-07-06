<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function about()
    {
        $page_data = Page::where('id', 1)->get();
        return view('admin.page_about', compact('page_data'));
    }

    public function about_update(Request $request)
    {
        $request->validate([
            'about_title' => 'required',
            'about_detail' => 'required'
        ]);

        $page = Page::where('id',$request->id)->first();
        $page->about_title = $request->about_title;
        $page->about_detail = $request->about_detail;
        $page->about_status = $request->about_status;
        $page->update();

        return redirect()->route('admin_page_about')->with('success', 'Page About được cập nhật thành công.');
    }

    public function terms()
    {
        $terms_data = Page::where('id', 1)->get();
        return view('admin.page_terms', compact('terms_data'));
    }

    public function terms_update(Request $request)
    {
        $request->validate([
            'terms_title' => 'required',
            'terms_detail' => 'required'
        ]);

        $page = Page::where('id',$request->id)->first();
        $page->terms_title = $request->terms_title;
        $page->terms_detail = $request->terms_detail;
        $page->terms_status = $request->terms_status;
        $page->update();

        return redirect()->route('admin_page_terms')->with('success', 'Terms được cập nhật thành công.');
    }

    public function privacy()
    {
        $privacy_data = Page::where('id', 1)->get();
        return view('admin.page_privacy', compact('privacy_data'));
    }

    public function privacy_update(Request $request)
    {
        $request->validate([
            'privacy_title' => 'required',
            'privacy_detail' => 'required'
        ]);

        $page = Page::where('id',$request->id)->first();
        $page->privacy_title = $request->privacy_title;
        $page->privacy_detail = $request->privacy_detail;
        $page->privacy_status = $request->privacy_status;
        $page->update();

        return redirect()->route('admin_page_privacy')->with('success', 'Privacy được cập nhật thành công.');
    }

    public function disclaimer()
    {
        $disclaimer_data = Page::where('id', 1)->get();
        return view('admin.page_disclaimer', compact('disclaimer_data'));
    }

    public function disclaimer_update(Request $request)
    {
        $request->validate([
            'disclaimer_title' => 'required',
            'disclaimer_detail' => 'required'
        ]);

        $page = Page::where('id',$request->id)->first();
        $page->disclaimer_title = $request->disclaimer_title;
        $page->disclaimer_detail = $request->disclaimer_detail;
        $page->disclaimer_status = $request->disclaimer_status;
        $page->update();

        return redirect()->route('admin_page_disclaimer')->with('success', 'Disclaimer được cập nhật thành công.');

    }

    public function login()
    {
        $login_data = Page::where('id', 1)->get();
        return view('admin.page_login', compact('login_data'));
    }

    public function login_update(Request $request)
    {
        $request->validate([
            'login_title' => 'required'
        ]);

        $page = Page::where('id',$request->id)->first();
        $page->login_title = $request->login_title;
        $page->login_status = $request->login_status;
        $page->update();

        return redirect()->route('admin_page_login')->with('success', 'Login được cập nhật thành công.');
    }

}

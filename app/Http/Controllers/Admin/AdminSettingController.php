<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $setting_data = Setting::where('id', 1)->first();
        return view('admin.setting', compact('setting_data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'news_ticker_total' => 'required',
        ]);
        
        $setting = Setting::where('id',1)->first();
        $setting->news_ticker_total = $request->news_ticker_total;
        $setting->news_ticker_status = $request->news_ticker_status;
        $setting->address = $request->address;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->contacts_status = $request->contacts_status;
        $setting->about = $request->about;
        $setting->about_status = $request->about_status;
        $setting->update();
        return redirect()->route('admin_setting')->with('success', 'Dữ liệu được cập nhật thành công.');
    }

}

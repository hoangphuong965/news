<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Language;
use App\Helper\Helpers;

class PrivacyController extends Controller
{
    public function index()
    {
        $privacy_data = Page::where('id', 1)->first();
        return view('front.privacy', compact('privacy_data'));
    }
}
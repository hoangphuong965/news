<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{
    public function index()
    {     
        $news_total = Post::count();
        $authors_total = Author::count();
        return view("admin.home", compact('news_total', 'authors_total'));
    }

    
}

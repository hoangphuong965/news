<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Setting;
use App\Models\SocialItem;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $categories = Category::with('rSubcategory')->where('show_on_menu', 'Show')->orderBy('category_order','asc')->get();
        $page_data = Page::where('id', 1)->first();
        $recent_news_data = Post::orderBy('id', 'desc')->get();
        $popular_news_data = Post::orderBy('visitors', 'desc')->get();
        $social_item_data = SocialItem::get();
        $setting_data = Setting::where('id', 1)->first();

        
        view()->share('global_categories', $categories);
        view()->share('global_page_data', $page_data);
        view()->share('global_recent_news_data', $recent_news_data);
        view()->share('global_popular_news_data', $popular_news_data);
        view()->share('global_social_item_data', $social_item_data);
        view()->share('global_setting_data', $setting_data);
    }
}

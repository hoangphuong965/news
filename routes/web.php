<?php

use App\Http\Controllers\Admin\AdminAuthorController;
use App\Http\Controllers\Admin\AdminSocialItemController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminSubCategoryController;
use App\Http\Controllers\Author\AuthorHomeController;
use App\Http\Controllers\Author\AuthorPostController;
use App\Http\Controllers\Author\AuthorProfileController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\DisclaimerController;
use App\Http\Controllers\Front\LoginController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\PrivacyController;
use App\Http\Controllers\Front\SubCategoryController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\TagController;
use App\Http\Controllers\Front\TermsController;
use Illuminate\Support\Facades\Route;

/*============================ Front end home =========================================*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/subcategory-by-category/{id}', [HomeController::class, 'get_subcategory_by_category'])->name('subcategory_by_category');

Route::get('/search/result', [HomeController::class, 'search'])->name('search_result');

/*============================ Front end about =========================================*/
Route::get('/about', [AboutController::class, 'index'])->name('about');

/*============================ Front end posts-detail =========================================*/
Route::get('/news-detail/{id}', [PostController::class, 'detail'])->name('new_detail');

/*============================ Front end category =========================================*/
Route::get('/category/{id}', [SubCategoryController::class, 'index'])->name('category');

/*============================ Front end terms page =========================================*/
Route::get('/terms-and-conditions', [TermsController::class, 'index'])->name('terms');

/*============================ Front end privacy page =========================================*/
Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('privacy');

/*============================ Front end disclaimer page =========================================*/
Route::get('/disclaimer', [DisclaimerController::class, 'index'])->name('disclaimer');

/*============================ Front end login page =========================================*/
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-submit', [LoginController::class, 'login_submit'])->name('login_submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forget-password', [LoginController::class, 'forget_password'])->name('forget_password');
Route::post('/forget-password-submit', [LoginController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::get('/reset-password/{token}/{email}', [LoginController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password-submit', [LoginController::class, 'reset_password_submit'])->name('reset_password_submit');

/*============================ Front end Tag =========================================*/
Route::get('/tag/{tag_name}', [TagController::class, 'show'])->name('tag_posts_show');




/*============================ Author =========================================*/
Route::get('/author/home', [AuthorHomeController::class, 'index'])->name('author_home')->middleware('author:author');

Route::get('/author/edit-profile', [AuthorProfileController::class, 'index'])->name('author_profile')->middleware('author:author');
Route::post('/author/edit-profile-submit', [AuthorProfileController::class, 'profile_submit'])->name('author_profile_submit');

Route::get('/author/post/show', [AuthorPostController::class, 'show'])->name('author_post_show')->middleware('author:author');
Route::get('/author/post/create', [AuthorPostController::class, 'create'])->name('author_post_create')->middleware('author:author');
Route::post('/author/post/store', [AuthorPostController::class, 'store'])->name('author_post_store');
Route::get('/author/post/edit/{id}', [AuthorPostController::class, 'edit'])->name('author_post_edit')->middleware('author:author');
Route::post('/author/post/update/{id}', [AuthorPostController::class, 'update'])->name('author_post_update');
Route::get('/author/post/delete/{id}', [AuthorPostController::class, 'delete'])->name('author_post_delete')->middleware('author:author');
Route::get('/author/post/tag/delete/{id}/{id1}', [AuthorPostController::class, 'delete_tag'])->name('author_post_delete_tag')->middleware('author:author');





// ==========================================================================================================================================================================================================================





/*============================== Admin ===========================================*/ 
Route::get("/admin/home", [AdminHomeController::class, 'index'])->name("admin_home")->middleware('admin:admin');

Route::get("/admin/login", [AdminLoginController::class, 'index'])->name("admin_login");
Route::post("/admin/login-submit", [AdminLoginController::class, 'login_submit'])->name("admin_login_submit");

Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');

Route::get("/admin/forget-password", [AdminLoginController::class, 'forget_password'])->name("admin_forget_password");
Route::post("/admin/forget-password-submit", [AdminLoginController::class, 'forget_password_submit'])->name("admin_forget_password_submit");

Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'reset_password'])->name("admin_reset_password");
Route::get('/admin/update-password', [AdminLoginController::class, 'update_password'])->name('admin_reset_password');
Route::post('/admin/reset-password-submit', [AdminLoginController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])->name('admin_profile')->middleware('admin:admin');
Route::post('/admin/edit-profile-submit', [AdminProfileController::class, 'profile_submit'])->name('admin_profile_submit');

/*===================================== Admin Category ======================================= */
Route::get('/admin/category/create', [AdminCategoryController::class, 'create'])->name('admin_category_create')->middleware('admin:admin');

Route::get('/admin/category/show', [AdminCategoryController::class, 'show'])->name('admin_category_show')->middleware('admin:admin');

Route::post('/admin/category/store', [AdminCategoryController::class, 'store'])->name('admin_category_store')->middleware('admin:admin');

Route::get('/admin/category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin_category_edit')->middleware('admin:admin');

Route::post('/admin/category/update/{id}', [AdminCategoryController::class, 'update'])->name('admin_category_update')->middleware('admin:admin');

Route::get('/admin/category/delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin_category_delete')->middleware('admin:admin');

/*=========================== Admin Sub Category ================================ */
Route::get('/admin/sub-category/show', [AdminSubCategoryController::class, 'show'])->name('admin_sub_category_show')->middleware('admin:admin');

Route::get('/admin/sub-category/create', [AdminSubCategoryController::class, 'create'])->name('admin_sub_category_create')->middleware('admin:admin');

Route::post('/admin/sub-category/store', [AdminSubCategoryController::class, 'store'])->name('admin_sub_category_store')->middleware('admin:admin');

Route::get('/admin/sub-category/edit/{id}', [AdminSubCategoryController::class, 'edit'])->name('admin_sub_category_edit')->middleware('admin:admin');

Route::post('/admin/sub-category/update/{id}', [AdminSubCategoryController::class, 'update'])->name('admin_sub_category_update')->middleware('admin:admin');

Route::get('/admin/sub-category/delete/{id}', [AdminSubCategoryController::class, 'delete'])->name('admin_sub_category_delete')->middleware('admin:admin');

/*============================= Admin Post ================================= */
Route::get('/admin/post/show', [AdminPostController::class, 'show'])->name('admin_post_show')->middleware('admin:admin');

Route::get('/admin/post/create', [AdminPostController::class, 'create'])->name('admin_post_create')->middleware('admin:admin');

Route::post('/admin/post/store', [AdminPostController::class, 'store'])->name('admin_post_store');

Route::get('/admin/post/edit/{id}', [AdminPostController::class, 'edit'])->name('admin_post_edit')->middleware('admin:admin');

Route::post('/admin/post/update/{id}', [AdminPostController::class, 'update'])->name('admin_post_update');

Route::get('/admin/post/delete/{id}', [AdminPostController::class, 'delete'])->name('admin_post_delete')->middleware('admin:admin');

Route::get('/admin/post/tag/delete/{id}/{id1}', [AdminPostController::class, 'delete_tag'])->name('admin_post_delete_tag')->middleware('admin:admin');

/*============================= Admin Settings ================================= */
Route::get('/admin/setting', [AdminSettingController::class, 'index'])->name('admin_setting')->middleware('admin:admin');

Route::patch('/admin/setting/update', [AdminSettingController::class, 'update'])->name('admin_setting_update')->middleware('admin:admin');

/*============================= Admin About Page ================================= */
Route::get('/admin/page/about', [AdminPageController::class, 'about'])->name('admin_page_about')->middleware('admin:admin');

Route::post('/admin/page/about/update', [AdminPageController::class, 'about_update'])->name('admin_page_about_update');

/*============================= Admin Privacy Page ================================= */
Route::get('/admin/page/privacy', [AdminPageController::class, 'privacy'])->name('admin_page_privacy')->middleware('admin:admin');
Route::post('/admin/page/privacy/update', [AdminPageController::class, 'privacy_update'])->name('admin_page_privacy_update');

/*============================= Admin Terms Page ================================= */
Route::get('/admin/page/terms', [AdminPageController::class, 'terms'])->name('admin_page_terms')->middleware('admin:admin');
Route::post('/admin/page/terms/update', [AdminPageController::class, 'terms_update'])->name('admin_page_terms_update');

/*============================= Admin Privacy Page ================================= */
Route::get('/admin/page/disclaimer', [AdminPageController::class, 'disclaimer'])->name('admin_page_disclaimer')->middleware('admin:admin');

Route::post('/admin/page/disclaimer/update', [AdminPageController::class, 'disclaimer_update'])->name('admin_page_disclaimer_update');

/*============================= Admin Login Page ================================= */
Route::get('/admin/page/login', [AdminPageController::class, 'login'])->name('admin_page_login')->middleware('admin:admin');

Route::post('/admin/page/login/update', [AdminPageController::class, 'login_update'])->name('admin_page_login_update');

/*============================= Admin Social Item ================================= */
Route::get('/admin/social-item/show', [AdminSocialItemController::class, 'show'])->name('admin_social_item_show')->middleware('admin:admin');

Route::get('/admin/social-item/create', [AdminSocialItemController::class, 'create'])->name('admin_social_item_create')->middleware('admin:admin');

Route::post('/admin/social-item/store', [AdminSocialItemController::class, 'store'])->name('admin_social_item_store');

Route::get('/admin/social-item/edit/{id}', [AdminSocialItemController::class, 'edit'])->name('admin_social_item_edit')->middleware('admin:admin');

Route::post('/admin/social-item/update/{id}', [AdminSocialItemController::class, 'update'])->name('admin_social_item_update');

Route::get('/admin/social-item/delete/{id}', [AdminSocialItemController::class, 'delete'])->name('admin_social_item_delete')->middleware('admin:admin');

/*============================= Admin Athors ================================= */
Route::get('/admin/author/show', [AdminAuthorController::class, 'show'])->name('admin_author_show')->middleware('admin:admin');

Route::get('/admin/author/create', [AdminAuthorController::class, 'create'])->name('admin_author_create')->middleware('admin:admin');

Route::post('/admin/author/store', [AdminAuthorController::class, 'store'])->name('admin_author_store');

Route::get('/admin/author/edit/{id}', [AdminAuthorController::class, 'edit'])->name('admin_author_edit')->middleware('admin:admin');

Route::post('/admin/author/update/{id}', [AdminAuthorController::class, 'update'])->name('admin_author_update');

Route::get('/admin/author/delete/{id}', [AdminAuthorController::class, 'delete'])->name('admin_author_delete')->middleware('admin:admin');
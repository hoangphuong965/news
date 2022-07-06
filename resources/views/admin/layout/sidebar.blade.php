<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('admin_home')}}">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('admin_home')}}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{Route::is('admin_home') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin_home')}}">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <li class="{{Route::is('admin_setting') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin_setting')}}">
                    <i class="fas fa-cog"></i> <span>Setting</span>
                </a>
            </li>

            <li class="nav-item dropdown {{Route::is('admin_category_*') ||  Route::is('admin_sub_category_*') || Route::is('admin_post_*')? 'active' : ''}}">
                <a href="#" class="nav-link has-dropdown">
                    <i class="far fa-newspaper"></i>
                    <span>News</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{Route::is('admin_category_*') ? 'active' : ''}}">
                        <a class="nav-link" href="{{ route('admin_category_show') }}">
                            <i class="fas fa-angle-right"></i> Categories
                        </a>
                    </li>
                    <li class="{{Route::is('admin_sub_category_*') ? 'active' : ''}}">
                        <a class="nav-link" href="{{ route('admin_sub_category_show') }}">
                            <i class="fas fa-angle-right"></i> SubCategories
                        </a>
                    </li>
                    <li class="{{Route::is('admin_post_*') ? 'active' : ''}}">
                        <a class="nav-link" href="{{ route('admin_post_show') }}">
                            <i class="fas fa-angle-right"></i> Posts
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/page/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-copy"></i><span>Pages</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/page/about') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_page_about') }}">
                            <i class="fas fa-angle-right"></i> About
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/page/login') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_page_login') }}">
                            <i class="fas fa-angle-right"></i> Login
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/page/terms') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_page_terms') }}">
                            <i class="fas fa-angle-right"></i> Terms and Conditions
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/page/privacy') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_page_privacy') }}">
                            <i class="fas fa-angle-right"></i> Privacy Policy
                        </a>
                    </li>
                    <li class="{{ Request::is('admin/page/disclaimer') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_page_disclaimer') }}">
                            <i class="fas fa-angle-right"></i> Disclaimer
                        </a>
                    </li> 
                </ul>
            </li>

            <li class="{{ Request::is('admin/social-item/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin_social_item_show') }}">
                    <i class="fas fa-share-alt"></i> 
                    <span>Social Items</span>
                </a>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/author/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-users"></i>
                    <span>Authors</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/author/list') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin_author_show') }}">
                            <i class="fas fa-angle-right"></i> Authors List
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </aside>
</div>
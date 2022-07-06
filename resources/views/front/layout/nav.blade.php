<div class="top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul>
                    <li class="today-text">Hôm nay: @php echo date('d/m/Y') @endphp</li>
                    <li class="email-text">
                        @if ($global_setting_data->contacts_status == 'Show')
                            {{$global_setting_data->email}}
                        @endif
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="right">
                    @if ($global_page_data->about_status == 'Show')
                        <li class="menu"><a href="{{ route('about') }}">Về chúng tôi</a></li>
                    @endif
                    @if ($global_page_data->login_status == 'Show')
                        <li class="menu"><a href="{{ route('login') }}">Đăng Nhập</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="website-menu">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Trang chủ</a>
                            </li>
                            
                            @foreach ($global_categories as $item)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{$item->category_name}}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($item->rSubCategory as $item2)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('category',$item2->id) }}">
                                                {{ $item2->sub_category_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="item">
                    <h2 class="heading">Về Chúng Tôi</h2>
                    <p>
                        @if ($global_setting_data->about_status == 'Show')
                                {{$global_setting_data->about}}
                        @endif
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="item">
                    <h2 class="heading">Liên kết</h2>
                    <ul class="useful-links">
                        @if ($global_page_data->terms_status == 'Show')
                            <li><a href="{{ route('terms') }}">Các điều khoản và điều kiện</a></li>
                        @endif
                        @if ($global_page_data->privacy_status == 'Show')
                            <li><a href="{{ route('privacy') }}">Chính sách riêng tư</a></li>
                        @endif
                        @if ($global_page_data->disclaimer_status == 'Show')
                            <li><a href="{{ route('disclaimer') }}">Tuyên bố miễn trừ trách nhiệm</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            
            
            <div class="col-md-4">
                <div class="item">
                    <h2 class="heading">Liên Hệ</h2>
                    <div class="list-item">
                        <div class="left">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="right">
                            @if ($global_setting_data->contacts_status == 'Show')
                                {{$global_setting_data->address}}
                            @endif
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="left">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="right">
                            @if ($global_setting_data->contacts_status == 'Show')
                                {{$global_setting_data->email}}
                            @endif
                        </div>
                    </div>
                    <div class="list-item">
                        <div class="left">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="right">
                            @if ($global_setting_data->contacts_status == 'Show')
                                {{$global_setting_data->phone}}
                            @endif
                        </div>
                    </div>
                    <ul class="social">
                        @foreach ($global_social_item_data as $item)
                            <li>
                                <a href="{{$item->url}}" target="_blank">
                                    <i class="{{$item->icon}}"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="copyright">
    Copyright @php echo date('Y') @endphp, News. All Rights Reserved.
</div>

<div class="scroll-top">
    <i class="fas fa-angle-up"></i>
</div>
<script src="{{ asset('dist-front/js/custom.js') }}"></script>        

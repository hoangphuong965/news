@extends('front.layout.app')

@section('main_content')

{{-- ticker --}}
@if ($setting_data->news_ticker_status == "Show")
<div class="news-ticker-item">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="acme-news-ticker">
                    <div class="acme-news-ticker-label">Tin Mới Nhất</div>
                    <div class="acme-news-ticker-box">
                        <ul class="my-news-ticker">
                            @php $i=0; @endphp
                            @foreach ($posts_data as $item)
                                @php $i++; @endphp
                                @if($i>$setting_data->news_ticker_total)
                                    @break
                                @endif
                                <li>
                                    <a href="{{ route('new_detail', ['id'=>$item->id]) }}">
                                        {{$item->post_title}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- home main --}}
<div class="home-main">
    <div class="container">
        <div class="row g-2">
            <div class="col-lg-8 col-md-12 left">
                <div class="inner">
                    <div class="photo">
                        <div class="bg"></div>
                        <img src="{{ asset('uploads/'.$latest_news_center->post_photo) }}" alt="">
                        <div class="text">
                            <div class="text-inner">
                                <div class="category">
                                    <span class="badge bg-success badge-sm">
                                        {{$latest_news_center->rSubCategory->sub_category_name}}
                                    </span>
                                </div>
                                <h2>
                                    <a href="{{ route('new_detail', $latest_news_center->id) }}">{{$latest_news_center->post_title}}</a>
                                </h2>
                                <div class="date-user">
                                    <div class="user">
                                        @if($latest_news_center->author_id==0)
                                            @php echo $user_data = \App\Models\Admin::where('id',$latest_news_center->admin_id)->first()->name; @endphp
                                        @else
                                            @php echo $user_data = \App\Models\Author::where('id',$latest_news_center->author_id)->first()->name; @endphp
                                        @endif
                                    </div>
                                    <div class="date">
                                        <a href="">
                                            @php echo date('d/m/Y', strtotime($latest_news_center->created_at)) @endphp
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                @php $i=0; @endphp
                @foreach ($posts_data as $item)
                @php
                    $i++;
                    if($i == 1) {
                        continue;
                    } else if($i == 4){
                        break;
                    }     
                @endphp
                <div class="inner inner-right">
                    <div class="photo">
                        <div class="bg"></div>
                        <img src="{{ asset('uploads/'.$item->post_photo) }}" alt="">
                        <div class="text">
                            <div class="text-inner">
                                <div class="category">
                                    <span class="badge bg-success badge-sm">{{$item->rSubCategory->sub_category_name}}</span>
                                </div>
                                <h2>
                                    <a href="{{ route('new_detail', $item->id) }}">{{$item->post_title}}</a>
                                </h2>
                                <div class="date-user">
                                    <div class="user">
                                        <a href="">
                                            @if($item->author_id==0)
                                                @php echo $user_data = \App\Models\Admin::where('id',$item->admin_id)->first()->name; @endphp
                                            @else
                                                 @php echo $user_data = \App\Models\Author::where('id',$item->author_id)->first()->name; @endphp
                                            @endif
                                        </a>
                                    </div>
                                    <div class="date">
                                        <a href="">
                                            @php echo date('d/m/Y', strtotime($item->updated_at)) @endphp
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- search section --}}
<div class="search-section">
    <div class="container">
        <div class="inner">
            <form action="{{ route('search_result') }}" method="get">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" name="text_item" class="form-control" placeholder="Tìm kiếm theo tiêu đề">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="category" id="category" class="form-select">
                                <option value="">Select Category</option>
                                @foreach ($category_data as $item)
                                    <option value="{{$item->id}}">{{$item->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="sub_category" id="sub_category" class="form-select">
                                <option value="">Select SubCategory</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- home content --}}
<div class="home-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 left-col">
                <div class="left">
                    <div class="news-total-item">
                        @foreach ($sub_category_data as $item)
                            @if(count($item->rPost)==0)
                                @continue
                            @endif
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <h2>{{ $item->sub_category_name }}</h2>
                                </div>
                                <div class="col-lg-6 col-md-12 see-all">
                                    <a href="{{ route('category', ['id'=>$item->id]) }}" class="btn btn-primary btn-sm">Xem tất cả</a>
                                </div>
                                <div class="col-md-12">
                                    <div class="bar"></div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- left side --}}
                                @foreach ($item->rPost as $single)
                                    @if ($loop->iteration == 2)
                                        @break
                                    @endif                                    
                                    <div class="col-lg-6 col-md-12">
                                        <div class="left-side">
                                            <div class="photo">
                                                <img src="{{ asset('uploads/'.$single->post_photo) }}" alt="">
                                            </div>
                                            <h3>
                                                <a href="{{ route('new_detail', ['id'=>$single->id]) }}">
                                                    {{$single->post_title}}
                                                </a>
                                            </h3>
                                            <div class="date-user">
                                                <div class="user">
                                                    <a href="">
                                                        @if($single->author_id==0)
                                                            @php echo $user_data = \App\Models\Admin::where('id',$single->admin_id)->first()->name; @endphp
                                                        @else
                                                            @php echo $user_data = \App\Models\Author::where('id',$single->author_id)->first()->name; @endphp
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="date">
                                                    <a href="javascript:void">
                                                        @php echo date('d/m/Y', strtotime($single->updated_at)) @endphp
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- right side --}}
                                <div class="col-lg-6 col-md-12">
                                    <div class="right-side">
                                    @foreach ($item->rPost as $single)
                                        @if ($loop->iteration == 1)
                                            @continue
                                        @endif
                                        @if($loop->iteration == 6)
                                            @break
                                        @endif
                                            <div class="right-side-item">
                                                <div class="left">
                                                    <img src={{ asset('uploads/'.$single->post_photo) }} alt="">
                                                </div>
                                                <div class="right">
                                                    <h2>
                                                        <a href="{{ route('new_detail', ['id'=>$single->id]) }}">
                                                            {{$single->post_title}}
                                                        </a>
                                                    </h2>
                                                    <div class="date-user">
                                                        <div class="user">
                                                            @if($single->author_id==0)
                                                                @php echo $user_data = \App\Models\Admin::where('id',$single->admin_id)->first()->name; @endphp
                                                            @else
                                                                @php echo $user_data = \App\Models\Author::where('id',$single->author_id)->first()->name; @endphp
                                                            @endif
                                                        </div>
                                                        <div class="date">
                                                            <a href="">
                                                                @php echo date('d/m/Y', strtotime($single->created_at)) @endphp
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                    @endforeach
                                </div>
                            </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- side bar --}}
            <div class="col-lg-4 col-md-6 sidebar-col">
                @include('front.layout.sidebar')
            </div>
        </div>
    </div>
</div>

<script>
    (function($){
        $(document).ready(function(){
            $('#category').on('change', function(){
                const categoryId = $("#category").val();
                if(categoryId) {
                    $.ajax({
                        type: "get",
                        url: "{{ url('subcategory-by-category/') }}" + "/" + categoryId,
                        success: function (response) {
                            $('#sub_category').html(response.sub_category_data);
                        },
                        error: function (err) {
                            
                        }
                    })
                }
            })
        });
    })(jQuery)
</script>

@endsection
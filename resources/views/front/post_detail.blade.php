@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$post_detail->post_title}}</h2>
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('category', ['id'=>$post_detail->rSubCategory->id]) }}">
                                {{$post_detail->rSubCategory->sub_category_name}}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$post_detail->post_title}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="featured-photo">
                    <img src="{{ asset('uploads/'.$post_detail->post_photo) }}" alt="">
                </div>
                <div class="sub">
                    <div class="item">
                        <b><i class="fas fa-user"></i></b>
                        <a href="">
                            @if($post_detail->author_id==0)
                                @php echo $user_data = \App\Models\Admin::where('id',$post_detail->admin_id)->first()->name; @endphp
                            @else
                                @php echo $user_data = \App\Models\Author::where('id',$post_detail->author_id)->first()->name; @endphp
                            @endif
                        </a>
                    </div>
                    <div class="item">
                        <b><i class="fas fa-edit"></i></b>
                        <a href="{{ route('category', ['id'=>$post_detail->rSubCategory->id]) }}">{{$post_detail->rSubCategory->sub_category_name}}</a>
                    </div>
                    <div class="item">
                        <b><i class="fas fa-clock"></i></b>
                        @php echo date('d/m/Y', strtotime($post_detail->created_at)) @endphp
                    </div>
                    <div class="item">
                        <b><i class="fas fa-eye"></i></b>
                        {{$post_detail->visitors}}
                    </div>
                </div>
                <div class="main-text">
                    {!!$post_detail->post_detail!!}
                </div>
                <div class="tag-section">
                    <h2>Tags</h2>
                    <div class="tag-section-content">
                        @foreach ($tag_data as $item)
                            <a href="{{ route('tag_posts_show', ['tag_name'=>$item->tag_name]) }}">
                                <span class="badge bg-success">{{$item->tag_name}}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
                {{-- related new --}}
                <div class="related-news">
                    <div class="related-news-heading">
                        <h2>Tin tức liên quan</h2>
                    </div>
                    <div class="related-post-carousel owl-carousel owl-theme">
                        @foreach($related_post_array as $item)
                        @if($item->id == $post_detail->id)
                            @continue
                        @endif
                        <div class="item">
                            <div class="photo">
                                <img src="{{ asset('uploads/'.$item->post_photo) }}" alt="">
                            </div>
                            <div class="category">
                                <span class="badge bg-success">{{ $item->rSubCategory->sub_category_name }}</span>
                            </div>
                            <h3>
                                <a href="{{ route('new_detail',$item->id) }}">{{ $item->post_title }}</a>
                            </h3>
                            <div class="date-user">
                                <div class="user">
                                    @if($item->author_id==0)
                                        @php echo $user_data = \App\Models\Admin::where('id',$item->admin_id)->first()->name; @endphp
                                    @else
                                        @php echo $user_data = \App\Models\Author::where('id',$item->author_id)->first()->name; @endphp
                                    @endif
                                    <a href="javascript:void;">{{ $item->name }}</a>
                                </div>
                                <div class="date">
                                    @php echo date('d/m/Y', strtotime($item->created_at)) @endphp
                                </div>
                            </div>
                        </div>
                        @endforeach 

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 sidebar-col">
                @include('front.layout.sidebar');
            </div>`
        </div>
    </div>
</div>
@endsection


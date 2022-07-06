@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Category: {{$sub_category_data->sub_category_name}}</h2>
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$sub_category_data->sub_category_name}}
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
            <div class="col-md-12">
                <div class="col-lg-8 col-md-6">
                        
                    <div class="category-page">
                        <div class="row">
                            @if (count($post_data))
                            @foreach ($post_data as $item)                                
                                <div class="col-lg-6 col-md-12">
                                    <div class="category-page-post-item">
                                        <div class="photo">
                                            <img src="{{ asset("uploads/".$item->post_photo) }}" alt="">
                                        </div>
                                        <h3>
                                            <a href="{{ route('new_detail', ['id'=>$item->id]) }}">
                                                {{$item->post_title}}
                                            </a>
                                        </h3>
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
                                                    @php echo date('d/m/Y', strtotime($item->created_at)) @endphp
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                            <span class="text-danger">Nội dung đang được cập nhật</span>
                            <a href="{{ route('home') }}">Trở về trang chủ</a>
                            @endif
                            <div class="col-md-12">
                                {{$post_data->links()}}
                            </div>
    
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


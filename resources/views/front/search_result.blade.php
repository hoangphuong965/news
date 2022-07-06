@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Kết quả tìm kiếm</h2>
                <nav class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kết quả Tìm kiếm</li>
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
                        
                <div class="category-page">
                    <div class="row">


                        @if(count($posts_data))
                        @foreach($posts_data as $item)
                        <div class="col-lg-6 col-md-12">
                            <div class="category-page-post-item">
                                <div class="photo">
                                    <img src="{{ asset('uploads/'.$item->post_photo) }}" alt="">
                                </div>
                                <div class="category">
                                    <span class="badge bg-success">{{ $item->rSubCategory->sub_category_name }}</span>
                                </div>
                                <h3><a href="{{ route('new_detail',$item->id) }}">{{ $item->post_title }}</a></h3>
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
                                        <a href="javascript:void">
                                            @php echo date('d/m/Y', strtotime($item->created_at)) @endphp
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                            <span class="text-danger">Kết quả tìm kiếm: không có</span>
                        @endif


                        <div class="col-md-12">
                            {{ $posts_data->links() }}
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6 sidebar-col">
               
                @include('front.layout.sidebar')
               
            </div>



        </div>
    </div>
</div>
@endsection
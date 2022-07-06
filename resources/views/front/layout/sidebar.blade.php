<div class="sidebar">
    
    {{-- Popular News --}}
    <div class="widget">
        <div class="news">
            <div class="news-heading">
                <h2>Tin tức</h2>
            </div>           

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Tin Gần Đây</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Tin Phổ Biến</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                    @foreach ($global_recent_news_data as $item)
                    @if ($loop->iteration == 6)
                        @break;
                    @endif
                    <div class="news-item">
                        <div class="left">
                            <img src="{{ asset('uploads/'.$item->post_photo) }}" alt="">
                        </div>
                        <div class="right">
                            <div class="category">
                                <span class="badge bg-success">
                                    {{$item->rSubCategory->sub_category_name}}
                                </span>
                            </div>
                            <h2>
                                <a href="{{ route('new_detail', ['id'=>$item->id]) }}">{{$item->post_title}}</a>
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
                                        @php echo date('d/m/Y', strtotime($item->created_at)) @endphp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    
                    @foreach ($global_popular_news_data as $item)
                    @if ($loop->iteration == 6)
                        @break;
                    @endif
                    <div class="news-item">
                        <div class="left">
                            <img src="{{ asset('uploads/'.$item->post_photo) }}" alt="">
                        </div>
                        <div class="right">
                            <div class="category">
                                <span class="badge bg-success">
                                    {{$item->rSubCategory->sub_category_name}}
                                </span>
                            </div>
                            <h2>
                                <a href="{{ route('new_detail', ['id'=>$item->id]) }}">{{$item->post_title}}</a>
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
                                        @php echo date('d/m/Y', strtotime($item->created_at)) @endphp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    @endforeach

                </div>
            </div>
        </div>
    </div>

        {{-- Tags --}}
        <div class="widget">
            <div class="tag-heading">
                <h2>Tags</h2>
            </div>
            <div class="tag">
                @php
                    $all_tags = \App\Models\Tag::select('tag_name')->distinct()->get();
                @endphp
                @foreach ($all_tags as $item) 
                    <div class="tag-item">
                        <a href="{{ route('tag_posts_show', ['tag_name'=>$item->tag_name]) }}">
                            <span class="badge bg-secondary">{{$item->tag_name}}</span>
                        </a>
                    </div>
                @endforeach
                
            </div>
        </div>

</div>
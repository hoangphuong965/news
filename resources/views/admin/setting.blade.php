@extends('admin.layout.app')

@section('heading', 'Setting')

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin_setting_update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="v-1-tab" data-toggle="pill" href="#v-1" role="tab" aria-controls="v-1" aria-selected="true">
                                            Ticker                                         </a>
                                        <a class="nav-link" id="v-2-tab" data-toggle="pill" href="#v-2" role="tab" aria-controls="v-2" aria-selected="false">
                                            Contact
                                        </a>
                                        <a class="nav-link" id="v-3-tab" data-toggle="pill" href="#v-3" role="tab" aria-controls="v-3" aria-selected="false">
                                            About
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12">
                                    <div class="tab-content" id="v-pills-tabContent">
                                       
                                        <div class="pt_0 tab-pane fade show active" id="v-1" role="tabpanel" aria-labelledby="v-1-tab">
                                            <!-- Home Page Start -->
                                            <div class="form-group mb-3">
                                                <label>News Ticker Total *</label>
                                                <input type="text" class="form-control" name="news_ticker_total" value="{{$setting_data->news_ticker_total}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>News Ticker Status</label>
                                                <select name="news_ticker_status" class="form-control">
                                                    <option value="Show" @if ($setting_data->news_ticker_status == 'Show') selected @endif>
                                                        Show
                                                    </option>
                                                    <option value="Hide" @if ($setting_data->news_ticker_status == 'Hide') selected @endif>
                                                        Hide
                                                    </option>
                                                </select>
                                            </div>
                                            <!-- Home Page End -->
                                        </div>

                                        <div class="pt_0 tab-pane fade" id="v-2" role="tabpanel" aria-labelledby="v-2-tab">
                                            <!-- Text Address Start -->
                                            <div class="form-group mb-3">
                                                <label>Địa chỉ</label>
                                                <input type="text" class="form-control" name="address" value="{{$setting_data->address}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Email</label>
                                                <input type="text" class="form-control" name="email" value="{{$setting_data->email}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{$setting_data->phone}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Status</label>
                                                <select name="contacts_status" class="form-control">
                                                    <option value="Show" @if ($setting_data->contacts_status == 'Show') selected @endif>
                                                        Show
                                                    </option>
                                                    <option value="Hide" @if ($setting_data->contacts_status == 'Hide') selected @endif>
                                                        Hide
                                                    </option>
                                                </select>
                                            </div>
                                            <!-- Text Address End -->
                                        </div>

                                        <div class="pt_0 tab-pane fade" id="v-3" role="tabpanel" aria-labelledby="v-3-tab">
                                            <!-- About Start -->
                                            <div class="form-group mb-3">
                                                <label>About</label>
                                                <input type="text" class="form-control" name="about" value="{{$setting_data->about}}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Status</label>
                                                <select name="about_status" class="form-control">
                                                    <option value="Show" @if ($setting_data->about_status == 'Show') selected @endif>
                                                        Show
                                                    </option>
                                                    <option value="Hide" @if ($setting_data->about_status == 'Hide') selected @endif>
                                                        Hide
                                                    </option>
                                                </select>
                                            </div>
                                            <!-- About End -->
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt_30">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
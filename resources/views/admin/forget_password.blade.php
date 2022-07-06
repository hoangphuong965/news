<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="uploads/favicon.png">

    <title>Forget Password - Admin Panel</title>

    @include('admin.layout.styles')
    @include('admin.layout.scripts')
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <section class="section">
            <div class="container container-login">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary border-box">
                            <div class="card-header card-header-auth">
                                <h4 class="text-center">Reset Password</h4>
                            </div>
                            <div class="card-body card-body-auth">
                                <form method="POST" action="{{ route('admin_forget_password_submit')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('email')is-invalid @enderror" name="email" placeholder="Email Address" value="{{old('email')}}" autofocus>
                                        @error('email')
                                            <p style="color: brown">{{ $message }}</p>
                                        @enderror
                                        @if (session()->get('error'))
                                            <p style="color: brown">{{ session()->get('error') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Send Password Reset Link
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <a href="{{ route('admin_login') }}">
                                                Back to login page
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@include('admin.layout.scripts_footer')

</body>
</html>
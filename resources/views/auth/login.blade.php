<html lang="en">

<head>
    <!-- Latest compiled and minified CSS -->
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('client/css/login.css') }}">
</head>

<body>
    <div id="form">
        <div class="container">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-md-8 col-md-offset-2">
                <div id="userform">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li>
                            <a href="{{ route('signin') }}">Bạn chưa có tài khoản</a>
                        </li>
                    </ul>
                    @include('admin/alert/alert_msg')
                    @include('admin/alert/aletr_msg_eror')
                    <div class="tab-content">

                        <div class="tab-pane active fade in" id="login">
                            <h2 class="text-uppercase text-center"> Nhập tài khoản</h2>
                            <form action="{{ route('user_login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label><span class="req"></span> </label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Nhập tài khoản email *"><br>
                                    @if ($errors->has('email'))
                                        <span class="text-danger text-sm"> {{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label><span class="req"></span> </label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Nhập mật khẩu *">
                                    @if ($errors->has('password'))
                                        <span class="text-danger text-sm"> {{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="mrgn-30-top">
                                    <button type="submit" class="btn btn-larger btn-block" />
                                    Đăng nhập
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

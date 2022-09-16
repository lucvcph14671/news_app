<html lang="en">

<head>
    <!-- Latest compiled and minified CSS -->
    <title>Trang đăng kí tài khoản mới</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('client/css/login.css') }}">
</head>

<body>
    <div id="form">
        <div class="container">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-md-8 col-md-offset-2">
                <div id="userform">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li><a href="{{ route('login') }}">Bạn đã có tài khoản</a></li>
                    </ul>
                    @include('admin/alert/alert_msg')
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="signup">
                            <h2 class="text-uppercase text-center"> Đăng kí tài khoản</h2>
                            <form method="POST" action="{{route('add_user')}}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}"
                                    placeholder="Nhập tên & tên đệm*">
                                    <p class="help-block text-danger"></p>
                                </div><br>
                                @if ($errors->has('name'))
                                    <span class="text-danger text-sm"> {{ $errors->first('name') }}</span>
                                @endif
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" value="{{old('email')}}"
                                    placeholder="Nhập email*">
                                    <p class="help-block text-danger"></p>
                                </div><br>
                                @if ($errors->has('email'))
                                    <span class="text-danger text-sm"> {{ $errors->first('email') }}</span>
                                @endif
                                <div class="form-group">
                                    <input type="tel" class="form-control" name="phone" value="{{old('phone')}}"
                                    placeholder="Nhập số điện thoại*">
                                    <p class="help-block text-danger"></p>
                                </div><br>
                                @if ($errors->has('phone'))
                                    <span class="text-danger text-sm"> {{ $errors->first('phone') }}</span>
                                @endif
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" value="{{old('password')}}"
                                    placeholder="Nhập mật khẩu*">
                                    <p class="help-block text-danger"></p>
                                </div><br>
                                @if ($errors->has('password'))
                                    <span class="text-danger text-sm"> {{ $errors->first('password') }}</span>
                                @endif
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Nhập lại mật khẩu*">
                                    <p class="help-block text-danger"></p>
                                </div><br>
                                <div class="mrgn-30-top">
                                    <button type="submit" class="btn btn-larger btn-block" />
                                    Đăng kí
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

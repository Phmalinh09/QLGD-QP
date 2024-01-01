<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Đăng nhập</title>

    <link rel="shortcut icon" href="{{('assets/img/logodhxd-small.png')}}">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugins/feather/feather.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugins/icons/flags/flags.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="{{asset('assets/img/logo-dhxd.png')}}" alt="Logo" width="250" height="250" style="margin-bottom: 55px;">
                        <img class="img-fluid" src="{{asset('assets/img/logo-dhxd1.png')}}" alt="Logo" width="550" height="250" style="margin-bottom: 40px;">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h2 style="font-size: 20px; margin-top: -40px;text-align: center;">QUẢN LÝ SINH VIÊN HỌC AN-QP</h2>
                            <h1 style=" margin-top: 50px; text-align: center; margin-top: -30px;">CHUYÊN VIÊN </h1>
                            <h1 style=" margin-top: 30px; text-align: center; margin-bottom: 30px;">THAY ĐỔI MẬT KHẨU</h1>

                            <form action="{{route('chuyenvien.reset-password-handler',['token'=>request()->token])}}" method="post">
                                @csrf
                                @if ( Session::get('fail') )
                                <div class="alert alert-success">
                                    {{ Session::get('fail') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                @if ( Session::get('success') )
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label>Mật khẩu mới <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" type="password" value="{{old('new_password')}}" name="new_password" id="new_password" required>
                                    <span class="profile-views feather-eye toggle-password"></span>
                                </div>
                                @error('new_password')
                                <div class="d-block text-danger" style="margin-top: 25px; margin-bottom:15px;">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label>Xác nhận mật khẩu <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" type="password" value="{{old('new_password_confi')}}" name="new_password_confi" id="new_password_confi" required>
                                    <span class="profile-views feather-eye toggle-password"></span>
                                </div>
                                @error('new_password_confi')
                                <div class="d-block text-danger" style="margin-top: 25px; margin-bottom:15px;">{{ $message }}</div>
                                @enderror
                                
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Thay đổi mật khẩu</button>
                                </div>
                                @if(session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: -2.2rem">
                                   
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">{{session('error')}}
                                        </font>
                                    </font>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                                </div>
                                @endif
                                <!-- <div class="ajs-message ajs-error ajs-visible"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{session('error')}}</font></font></div> -->
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/js/feather.min.js')}}"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>
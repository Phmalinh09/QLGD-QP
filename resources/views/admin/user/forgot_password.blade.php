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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

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
                            <h1 style=" margin-top: 50px; text-align: center; margin-top: -30px;">Quản trị viên</h1>
                            <h1 style=" margin-top: 30px; text-align: center; margin-bottom: 30px;">ĐẶT LẠI MẬT KHẤU</h1>


                            <form action="{{route('admin.forgot-passwords')}}" method="post">
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
                                    <label>Nhập địa chỉ email đã đăng ký của bạn <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Email" name="email" value="{{old('email')}}">
                                    <span class="profile-views"><i class="fas fa-envelope"></i></span>
                                </div>

                                @error('email')
                                <div class="d-block text-danger" style="margin-top: 25px; margin-bottom: 15px;">{{$message}}</div>
                                @enderror
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Đặt lại mật khẩu của tôi</button>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary primary-reset btn-block" type=""><a href="{{route('admin.login')}}" style="color: aliceblue;">Đăng nhập</a></button>
                                </div>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    @if(Session::has('message'))
    <script>
        var type = "{{ Session::get('alert-type','info')}}"
        switch (type) {
            case 'info':
                toastr.info("{{Session::get('message')}}");
                break;
            case 'success':
                toastr.success("{{Session::get('message')}}");
                break;
            case 'warning':
                toastr.warning("{{Session::get('message')}}");
                break;
            case 'error':
                toastr.error("{{Session::get('message')}}");
                break;
        }
    </script>
    @endif
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('page_title')</title>
    <link rel="shortcut icon" href="{{asset('assets/img/logodhxd-small.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/icons/flags/flags.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/ckeditor.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('assets/plugins//toastr/toatr.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

</head>

<body>

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left">
                <a href="{{url('chuyenvien/tongquan')}}" class="logo">
                    <img src="{{asset('assets/img/logodhxd.png')}}" alt="Logo">
                </a>
                <a href="{{url('chuyenvien/tongquan')}}" class="logo logo-small">
                    <img src="{{asset('assets/img/logodhxd-small.png')}}" alt="Logo" width="30" height="30">
                </a>
            </div>
            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Tìm kiếm ở đây">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>

            <ul class="nav user-menu">
                <li class="nav-item dropdown noti-dropdown me-2">
                    <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                        <img src="{{asset('assets/img/icons/header-icon-05.svg')}}" alt="">
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Thông báo</span>
                            <a href="javascript:void(0)" class="clear-noti"> Xóa tất cả </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="#">Xem tất cả thông báo</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item zoom-screen me-2">
                    <a href="#" class="nav-link header-nav-list win-maximize">
                        <img src="{{asset('assets/img/icons/header-icon-04.svg')}}" alt="">
                    </a>
                </li>

                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{(!empty(Auth::user()->hinhanh))? url('upload/admin_image/'.Auth::user()->hinhanh):url('upload/admin_image/images.png')}}" width="31" alt="Soeng Souy">
                            <div class="user-text">
                                <h6>{{Auth::user()->name}}</h6>
                                <p class="text-muted mb-0">{{Auth::user()->vaitro}}</p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="{{(!empty(Auth::user()->hinhanh))? url('upload/admin_image/'.Auth::user()->hinhanh):url('upload/admin_image/images.png')}}" alt="User Image" class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6>{{Auth::user()->name}}</h6>
                                <p class="text-muted mb-0">{{Auth::user()->vaitro}}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{route('chuyenvien.profile')}}">Thông tin</a>
                        <a class="dropdown-item" href="{{route('chuyenvien.logout')}}">Đăng xuất</a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="@yield('tongquan_select')"><a href="{{url('chuyenvien/tongquan')}}"> <i class="feather-grid"></i><span>TRANG CHỦ</span></a></li>
                        <li class="@yield('phong_select')"><a href="{{route('cvphong.index')}}"> <i class="fas fa-hotel"></i><span>QUẢN LÝ PHÒNG Ở</span></a></li>
                        <li class="@yield('phanphong_select')"><a href="{{route('cvphanphong.index')}}"> <i class="fas fa-building"></i><span>PHÂN PHÒNG</span></a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="page-wrapper">
            <div class="content container-fluid">
                @section('container')
                @show
            </div>
            <footer>
                <p>PHẠM THỊ MỸ LINH - 122064 - 64PM2</p>
            </footer>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#khoahocs').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: "{{ route('get-Dothoc') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            khoahoc_id: id
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#dothocs').empty();
                                $('#dothocs').append(`<option value="" hidden>Chọn đợt học</option>`);
                                $.each(data, function(index, dothocs) {
                                    $('select[name="dothocs"]').append('<option value="' + dothocs.id + '">' + dothocs.sodot + '</option>');
                                });
                            } else {
                                $('#dothocs').empty();
                            }
                        }
                    });
                } else {
                    $('#dothocs').empty();
                }
            });
        });


        $(document).ready(function() {
            $('#gioitinhs').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: "{{route('get-Gioitinh')}}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            phong_id: id
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#phongs').empty();
                                $('#phongs').append(`<option value="" hidden>Chọn phòng</option>`);
                                $.each(data, function(index, phongs) {
                                    var checkbox = '<div class"row col-md-21" style="float: left; margin: 5px 10px;"><input  type="checkbox" name="phongs[]"  value="' + phongs.id + '"> ' + ' ' + phongs.tenphong + '(' + phongs.socho + ')' + '</div>';
                                    $('#phongs').append(checkbox);
                                });
                            } else {
                                $('#phongs').empty();
                            }
                        }
                    });
                } else {
                    $('#phongs').empty();
                }
            });
        });
        $(document).ready(function() {
            $('#khoahocstk').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: "{{ route('get-Dothoctk') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            khoahoc_idtk: id
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#dothocstk').empty();
                                $('#dothocstk').append(`<option value="" hidden>Chọn đợt học</option>`);
                                $.each(data, function(index, dothocs) {
                                    $('select[name="dothocstk"]').append('<option value="' + dothocs.id + '">' + dothocs.sodot + '</option>');
                                });
                            } else {
                                $('#dothocstk').empty();
                            }
                        }
                    });
                } else {
                    $('#dothocstk').empty();
                }
            });
        });
    </script>



    <script type="text/javascript">
        $('.trangthais').change(function() {
            const trangthai = $(this).val();
            const sinhvien_id = $(this).data('sinhvien_id');
            var _token = $('input[name="_token"]').val();

            if (trangthai == 'Hoạt động') {
                var thongbao = ' Sinh viên hoạt động';
            } else {
                var thongbao = 'Sinh viên không hoạt động';
            }
            $.ajax({
                url: "{{url('/trang-thai')}}",
                method: "POST",
                data: {
                    trangthai: trangthai,
                    sinhvien_id: sinhvien_id,
                    _token: _token
                },
                success: function(data) {
                    // $('#thongbao').html('<span class="text text-alert"'+thongbao+'</span>');
                    alert(thongbao);
                }
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>


    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/feather.min.js')}}"></script>
    <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/ckeditor.js')}}"></script>
    <script src="{{asset('assets/plugins/apexchart/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/plugins/apexchart/chart-data.js')}}"></script>
    <!-- <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('assets/plugins/toastr/toastr.js')}}"></script> -->
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
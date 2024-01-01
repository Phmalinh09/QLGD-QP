@extends('admin/layout')
@section('page_title','Quản lý người dùng')
@section('nguoidung_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb" >
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý người dùng</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-5 col-md-5">
                <div class="form-group">
                    <input type="search" name="ten_user" class="form-control" placeholder="Tìm kiếm theo tên người dùng...">
                </div>
            </div>
            <div class="col-lg-5 col-md-5">
                <div class="form-group local-forms">
                    <select class="form-control select" name="vai_tro" id="vai_tro">
                        <option style="text-align: center;" value="">------ Tìm kiếm theo vai trò ------</option>
                        <option value="Admin">Admin</option>
                        <option value="Chuyên viên">Chuyên viên</option>
                    </select>
                </div>
            </div>


            <div class="col-lg-1">
                <div class="search-student-btn">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
            <div class="col-lg-1">
                <div class="search-student-btn1">
                    <a class="btn btn-primary" href="{{url('admin/user')}}"><i class="fa fa-undo"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('user.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>THÊM NGƯỜI DÙNG</span></h5>
                        </div>


                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Họ tên <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name">
                                @error('name')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Vai trò<span class="login-danger">*</span></label>
                                <select class="form-control select" name="vaitro" id="vaitro" aria-label=".form-select-sm example">
                                    <option value="Admin">Admin</option>
                                    <option value="Chuyên viên">Chuyên viên</option>
                                </select>
                                @error('vaitro')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Số điện thoại <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="sdt">
                                @error('sdt')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Địa chỉ <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="diachi">
                                @error('diachi')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Email <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="email" id="email">
                                @error('email')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Mật khẩu <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="password">
                                @error('password')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="student-submit">
                                <button type="submit" name="themdothoc" class="btn btn-primary">Thêm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card card-table comman-shadow">
            <div class="card-body">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">QUẢN LÝ NGƯỜI DÙNG</h3>
                        </div>

                    </div>
                </div>
                <div class="table-responsive ">
                    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                        <thead class="student-thread">
                            <tr>
                                <th>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" name="xoa_tat_ca" value="1">
                                    </div>
                                </th>
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>Vai trò</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th class="text-end">Hoạt động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $keys => $dothocs)
                            <tr>
                                <td>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" name="dothoc_ids[]" value="{{ $dothocs->id }}">
                                    </div>
                                </td>
                                <td>{{$dothocs->id}}</td>
                                <td>{{$dothocs->name}}</td>
                                <td>
                                    @if($dothocs->vaitro=='Admin')
                                    <span class="text text-success">Admin</span>
                                    @else
                                    <span class="text text-danger">Chuyên viên</span>
                                    @endif
                                </td>
                                <td>{{$dothocs->sdt}}</td>
                                <td>{{$dothocs->diachi}}</td>
                                <td>{{$dothocs->email}}</td>
                                <td class="text-end">
                                    <div class="actions">
                                        <a href="{{route('user.edit',[$dothocs->id])}}" class="btn btn-sm bg-danger-light">
                                            <i class="feather-edit"></i>
                                        </a>
                                        <form action="{{route('user.destroy',[$dothocs->id])}}" method="POST" style="margin-top:-4px;">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa người dùng nàykhông?')" class="btn btn-sm">

                                                <a class="btn btn-sm  bg-danger-light text-danger"><i class="far fa-trash-alt me-1"></i></a>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@extends('admin/layout')
@section('page_title','Chỉnh sửa thông tin')
@section('nguoidung_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">CHỈNH SỬA THÔNG TIN NGƯỜI DÙNG</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/user')}}">Quản lý người dùng</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa thông tin người dùng</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">           
            <div class="card-body">
                <form method="POST" action="{{route('user.update',[$user->id])}}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Họ tên <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                                @error('name')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Vai trò<span class="login-danger">*</span></label>
                                <select class="form-control select" name="vaitro" id="vaitro" value="{{$user->vaitro}}" aria-label=".form-select-sm example">
                                    <option value="Admin">Admin</option>
                                    <option value="Chuyên viên">Chuyên viên</option>
                                </select>
                                @error('vaitro')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Số điện thoại <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="sdt" value="{{$user->sdt}}">
                                @error('sdt')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Địa chỉ <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="diachi" value="{{$user->diachi}}">
                                @error('diachi')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-2">
                            <div class="student-submit">
                                <button type="submit" name="themdothoc" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
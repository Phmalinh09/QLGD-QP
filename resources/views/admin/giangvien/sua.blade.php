@extends('admin/layout')
@section('page_title','Chỉnh sửa thông tin giảng viên')
@section('giangvien_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">CHỈNH SỬA GIẢNG VIÊN</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/giangvien')}}">Giảng viên</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa giảng viên</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('giangvien.update',[$giangviens->id])}}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Tên giảng viên <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$giangviens->tengv}}" name="tengv">
                                @error('tengv')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Email <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$giangviens->email}}" name="email">
                                @error('email')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Số điện thoại <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$giangviens->sdt}}" name="sdt">
                                @error('sdt')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Trạng thái <span class="login-danger">*</span></label>
                                <select class="form-control select" name="trangthai" aria-label=".form-select-sm example">
                                    @if($giangviens->trangthai==0)
                                    <option selected value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                    @else
                                    <option value="0">Kích hoạt</option>
                                    <option selected value="1">Không kích hoạt</option>
                                    @endif
                                </select>
                            </div>
                        </div>          
                        <div class="col-12">
                            <div class="student-submit">
                                <button type="submit" name="themgiangvien" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('admin/layout')
@section('page_title','Chỉnh sửa đợt học')
@section('phong_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">CHỈNH SỬA PHÒNG Ở</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/phong')}}">Quản lý phòng ở</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa phòng ở</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">

            <div class="card-body">
                <form method="POST" action="{{route('phong.update',[$phongs->id])}}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>                   
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Tên phòng <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$phongs->tenphong}}"  name="tenphong" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Số chỗ <span class="login-danger">*</span></label>
                                <input type="number" class="form-control" value="{{$phongs->socho}}"  name="socho" readonly>
                                @error('socho')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Giới tính <span class="login-danger">*</span></label>
                                <select class="form-control select" name="gioitinh" aria-label=".form-select-sm example">
                                    @if($phongs->gioitinh=='Nam')
                                    <option selected value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    @else
                                    <option value="Nam">Nam</option>
                                    <option selected value="Nữ">Nữ</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
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
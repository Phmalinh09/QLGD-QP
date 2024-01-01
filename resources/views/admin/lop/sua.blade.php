@extends('admin/layout')
@section('page_title','Chỉnh sửa lớp quản lý')
@section('lop_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">CHỈNH SỬA LỚP QUẢN LÝ</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/lop')}}">Lớp quản lý</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa lớp quản lý</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{route('lop.update',[$lops->id])}}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group local-forms">
                                <label>Mã lớp <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="malop" value="{{$lops->malop}}">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group local-forms">
                                <label>Khóa học<span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoahocs" aria-label=".form-select-sm example">
                                    @foreach($khoahocs as $key =>$khoahoc)
                                    <option {{$khoahoc->id==$lops->khoahoc_id ? 'selected' : ''}} value="{{$khoahoc->id}}">{{$khoahoc->makhoahoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group local-forms">
                                <label>Khoa<span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoas" aria-label=".form-select-sm example">
                                    @foreach($khoas as $key =>$khoa)
                                    <option {{$khoa->id==$lops->khoa_id ? 'selected' : ''}} value="{{$khoa->id}}">{{$khoa->tenkhoa}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group local-forms">
                                <label>Ngành<span class="login-danger">*</span></label>
                                <select class="form-control select" name="nganhs" aria-label=".form-select-sm example">
                                    @foreach($nganhs as $key =>$nganh)
                                    <option {{$nganh->id==$lops->nganh_id ? 'selected' : ''}} value="{{$nganh->id}}">{{$nganh->tennganh}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="col-12 col-sm-6">
                            <div class="form-group local-forms">
                                <label>Trạng thái <span class="login-danger">*</span></label>
                                <select class="form-control select" name="trangthai" aria-label=".form-select-sm example">
                                    @if($lops->trangthai==0)
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
                                <button type="submit" name="sualop" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
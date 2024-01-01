@extends('admin/layout')
@section('page_title','Thêm lớp quản lý')
@section('lop_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">THÊM LỚP QUẢN LÝ</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/lop')}}">Lớp quản lý</a></li>
                <li class="breadcrumb-item active">Thêm lớp quản lý</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('lop.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>

                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Mã lớp <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('malop_text')}}" name="malop_text">
                                @error('malop')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                                <span class="form-text text-muted">Ví dụ: "68IT"</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Số lớp cần thêm <span class="login-danger">*</span></label>
                                <input type="number" class="form-control" value="{{old('so_luong')}}" name="so_luong">
                                <span class="form-text text-muted">Ví dụ: Thêm số lớp cần thêm của mã 68IT"</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Bổ sung thêm lớp <span class="login-danger">*</span></label>
                                <input type="text" class="form-control"  name="malop">
                                <span class="form-text text-muted">Ví dụ: "68IT1"</span>
                                @error('malop')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Khóa học <span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoahocs" aria-label=".form-select-sm example">
                                    @foreach($khoahocs as $key =>$khoahoc)
                                    <option value="{{$khoahoc->id}}">{{$khoahoc->makhoahoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Khoa <span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoas" id="khoass" aria-label=".form-select-sm example">
                                <option value="">Chọn khoa</option> 
                                    @foreach($khoas as $key =>$khoa)
                                    <option value="{{$khoa->id}}">{{$khoa->tenkhoa}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Ngành <span class="login-danger">*</span></label>
                                <select class="form-control select" name="nganhs" id="nganhs" aria-label=".form-select-sm example">
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Ngành <span class="login-danger">*</span></label>
                                <select class="form-control select" name="nganhs" aria-label=".form-select-sm example">
                                    @foreach($nganhs as $key =>$nganh)
                                    <option value="{{$nganh->id}}">{{$nganh->tennganh}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->



                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Trạng thái <span class="login-danger">*</span></label>
                                <select class="form-control select" name="trangthai" aria-label=".form-select-sm example">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="student-submit">
                                <button type="submit" name="themchuyennganh" class="btn btn-primary">Thêm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
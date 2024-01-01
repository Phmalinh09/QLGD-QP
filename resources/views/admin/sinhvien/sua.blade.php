@extends('admin/layout')
@section('page_title','Chỉnh sửa sinh viên')
@section('sinhvien_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">CHỈNH SỬA SINH VIÊN</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/sinhvien')}}">Sinh viên</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa sinh viên</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('sinhvien.update',[$sinhviens->id])}}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>MSSV <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="mssv" value="{{$sinhviens->mssv}}">
                                @error('mssv')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Họ đệm <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="hodem" value="{{$sinhviens->hodem}}">
                                @error('hodem')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Tên <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="ten" value="{{$sinhviens->ten}}">
                                @error('ten')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Giới tính <span class="login-danger">*</span></label>
                                <select class="form-control select" name="gioitinh" aria-label=".form-select-sm example">
                                    @if($sinhviens->gioitinh=='Nam')
                                    <option selected value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    @else
                                    <option value="Nam">Nam</option>
                                    <option selected value="Nữ">Nữ</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms calendar-icon">
                                <label>Ngày sinh <span class="login-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" value="{{$sinhviens->ngaysinh}}" name="ngaysinh" placeholder="DD-MM-YYYY">
                                @error('ngaysinh')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Số điện thoại <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="dienthoai" value="{{$sinhviens->dienthoai}}">
                                @error('dienthoai')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Lớp học<span class="login-danger">*</span></label>
                                <select class="form-control select" name="lops" aria-label=".form-select-sm example">
                                    @foreach($lops as $key =>$lop)
                                    <option {{$lop->id==$sinhviens->lop_id ? 'selected' : ''}} value="{{$lop->id}}">{{$lop->malop}}</option>
                                    @endforeach
                                </select>

                                @error('lops')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Khóa học<span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoahocs" aria-label=".form-select-sm example">
                                    @foreach($khoahocs as $key =>$khoahoc)
                                    <option {{$khoahoc->id==$sinhviens->khoahoc_id ? 'selected' : ''}} value="{{$khoahoc->id}}">{{$khoahoc->makhoahoc}}</option>
                                    @endforeach
                                </select>
                                @error('khoahocs')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Trạng thái <span class="login-danger">*</span></label>
                                <select class="form-control select" name="trangthai" aria-label=".form-select-sm example">
                                    @if($sinhviens->trangthai=='Hoạt động')
                                    <option selected value="Hoạt động">Hoạt động</option>
                                    <option value="Không hoạt động">Không hoạt động</option>
                                    @else
                                    <option value="Hoạt động">Hoạt động</option>
                                    <option selected value="Không hoạt động">Không hoạt động</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label"><strong>Ghi chú - (Lý do không hoạt động) </strong></label>
                            <div class="col-md-12">
                                <textarea type="text" class="form-control" value="{{$sinhviens->ghichu}}" name="ghichu" id="" rows="5" cols="5" style="resize: none;" placeholder="Nhập văn bản ở đây"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="student-submit">
                                <button type="submit" name="themkhoa" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
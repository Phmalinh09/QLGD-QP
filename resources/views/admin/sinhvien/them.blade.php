@extends('admin/layout')
@section('page_title','Thêm sinh viên')
@section('sinhvien_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">THÊM SINH VIÊN</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/sinhvien')}}">Sinh viên</a></li>
                <li class="breadcrumb-item active">Thêm sinh viên</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">

            <div class="card-body">
                <form method="POST" action="{{route('sinhvien.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>MSSV <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('mssv')}}" name="mssv">
                                @error('mssv')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Họ đệm <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('hodem')}}" name="hodem">
                                @error('hodem')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Tên <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('ten')}}" name="ten">
                                @error('ten')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Giới tính <span class="login-danger">*</span></label>
                                <select class="form-control select" name="gioitinh" aria-label=".form-select-sm example">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms calendar-icon">
                                <label>Ngày sinh <span class="login-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" value="{{old('ngaysinh')}}" name="ngaysinh" placeholder="DD-MM-YYYY">
                                @error('ngaysinh')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Số điện thoại <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('dienthoai')}}" name="dienthoai">
                                @error('dienthoai')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Khóa học<span class="login-danger">*</span></label>
                                
                                <select class="form-control select " name="khoahocs" id="khoahocss" aria-label=".form-select-sm example">
                                   <option value="">Chọn khóa học</option> 
                                @foreach($khoahocs as $key =>$khoahoc)
                                    <option value="{{$khoahoc->id}}">{{$khoahoc->makhoahoc}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('khoahocs')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Lớp học <span class="login-danger">*</span></label>
                                <select class="form-control select " id="lopss" name="lops" aria-label=".form-select-sm example">
                                    <!-- @foreach($lops as $key =>$lop)
                                    <option value="{{$lop->id}}">{{$lop->malop}}</option>
                                    @endforeach -->
                                </select>
                                @error('lops')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Lớp học <span class="login-danger">*</span></label>
                                <select class="form-control select "  name="lops" aria-label=".form-select-sm example">
                                    @foreach($lops as $key =>$lop)
                                    <option value="{{$lop->id}}">{{$lop->malop}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->
                        


                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Trạng thái <span class="login-danger">*</span></label>
                                <select class="form-control select" name="trangthai" aria-label=".form-select-sm example">
                                    <option value="Hoạt động">Hoạt động</option>
                                    <option value="Không hoạt động">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label"><strong>Ghi chú - (Lý do không hoạt động) </strong></label>
                            <div class="col-md-12">
                                <textarea type="text" class="form-control" value="{{old('ghichu')}}" name="ghichu" id="" rows="5" cols="5" style="resize: none;" placeholder="Nhập văn bản ở đây"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="student-submit">
                                <button type="submit" name="themsinhvien" class="btn btn-primary">Thêm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
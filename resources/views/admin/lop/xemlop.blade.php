@extends('admin/layout')
@section('page_title','Xem lớp quản lý')
@section('lop_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb" >
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/lop')}}">Lớp quản lý</a></li>
                <li class="breadcrumb-item active">{{$lops->malop}}</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="get">
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="form-group">
                    <input type="search" name="ms_sv" id="ms_sv" value="" class="form-control" placeholder="Tìm kiếm theo mã sinh viên...">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="form-group">
                    <input type="search" name="ho_ten" id="ho_ten" value="" class="form-control" placeholder="Tìm kiếm theo mã tên sinh viên...">
                </div>
            </div>

            <div class="col-lg-2">
                <div class="row">
                    <div class="search-student-btn">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


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
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Khóa học<span class="login-danger">*</span></label>

                                <input type="text" class="form-control" name="khoahocs_makhoahoc" value="{{ isset($khoahocs) ? $lops->khoahocs->makhoahoc : '' }}" readonly>
                                <input type="hidden" class="form-control" name="khoahocs" value="{{ isset($khoahocs) ? $lops->khoahocs->id : '' }}">
                            </div>
                        </div>

                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Lớp học <span class="login-danger">*</span></label>
                                <input style="background-color: #d4d4d4;" type="text" name="lops_malop" value="{{ isset($lops) ? $lops->malop : '' }}" class="form-control" readonly>
                                <input type="hidden" name="lops" value="{{ isset($lops) ? $lops->id : '' }}">
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>MSSV <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('mssv')}}" name="mssv">
                                @error('mssv')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Họ đệm <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('hodem')}}" name="hodem">
                                @error('hodem')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Tên <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('ten')}}" name="ten">
                                @error('ten')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Giới tính <span class="login-danger">*</span></label>
                                <select class="form-control select" name="gioitinh" aria-label=".form-select-sm example">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms calendar-icon">
                                <label>Ngày sinh <span class="login-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" value="{{old('ngaysinh')}}" name="ngaysinh" placeholder="DD-MM-YYYY">
                                @error('ngaysinh')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Số điện thoại <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('dienthoai')}}" name="dienthoai">
                                @error('dienthoai')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="col-12 col-sm-2">
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
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table comman-shadow">
            <div class="card-body">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Danh sách sinh viên lớp {{$lops->malop}}</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive ">
                    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                        <thead class="student-thread">
                            <tr>
                                <th>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something">
                                    </div>
                                </th>
                                <th>STT</th>
                                <th>Mã HS-SV</th>
                                <th>Họ đệm</th>
                                <th>Tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Số điện thoại</th>
                                <th>Lớp học</th>
                                <th>Khoa học</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hoạt động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sinhviens as $keys => $sinhvien)
                            <tr>
                                <td>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something">
                                    </div>
                                </td>
                                <td>{{$sinhvien->sttsinhvien}}</td>
                                <td>{{$sinhvien->mssv}}</td>
                                <td>{{$sinhvien->hodem}}</td>
                                <td>{{$sinhvien->ten}}</td>
                                <td>
                                    @if($sinhvien->gioitinh=='Nam')
                                    <span>Nam</span>
                                    @else
                                    <span>Nữ</span>
                                    @endif
                                </td>
                                <td>{{$sinhvien->ngaysinh}}</td>
                                <td>{{$sinhvien->dienthoai}}</td>
                                <td>{{$sinhvien->lops->malop}}</td>
                                <td>{{$sinhvien->khoahocs->makhoahoc}}</td>
                                <td>
                                        @if($sinhvien->trangthai=='Hoạt động')
                                        <span class="text text-success">Hoạt động</span>
                                        @else
                                        <span class="text text-danger">Không hoạt động</span>
                                        @endif
                                    </td>
                                <td class="text-end">
                                    <div class="actions">
                                        <a href="{{route('sinhvien.edit',[$sinhvien->id])}}" class="btn btn-sm bg-danger-light">
                                            <i class="feather-edit"></i>
                                        </a>

                                        <form action="{{route('sinhvien.destroy',[$sinhvien->id])}}" method="POST" style="margin-top:-4px;">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa sinh viên hay không?')" class="btn btn-sm">
                                                <a class="btn btn-sm bg-danger-light"><i class="fa fa-trash"></i></a>
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
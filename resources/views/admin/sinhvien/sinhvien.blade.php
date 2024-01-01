@extends('admin/layout')
@section('page_title','Sinh viên')
@section('sinhvien_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Sinh viên</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-2 col-md-6">
                <div class="form-group">
                    <input type="search" name="ms_sv" id="ms_sv" value="{{ request('ms_sv') }}" class="form-control" placeholder="Tìm kiếm theo mã...">
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="form-group">
                    <input type="search" name="ho_ten" id="ho_ten" value="{{ request('ho_ten') }}" class="form-control" placeholder="Tìm kiếm theo tên...">
                </div>
            </div>

            <div class="col-lg-3 col-md-1">
                <div class="form-group local-forms">

                    <select class="form-control select" name="lop_hoc" id="lop_hoc">
                        <option style="text-align: center;" value="">------- Tìm kiếm theo lớp --------</option>
                        @foreach ($lops as $lop)
                        <option value="{{ $lop->id }}" {{ request('lop_hoc') == $lop->id ? 'selected' : '' }}>
                            {{ $lop->malop }}
                        </option>
                        @endforeach
                    </select>


                </div>
            </div>
            <div class="col-lg-3 col-md-1">
                <div class="form-group local-forms">
                    <select class="form-control select" name="khoa_hoc" id="khoa_hoc">
                        <option style="text-align: center;" value="">--- Tìm kiếm theo khóa học ---</option>
                        @foreach ($khoahocs as $khoahoc)
                        <option value="{{ $khoahoc->id }}" {{ request('khoa_hoc') == $khoahoc->id ? 'selected' : '' }}>
                            {{ $khoahoc->makhoahoc }}
                        </option>
                        @endforeach
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
                    <a class="btn btn-primary" href="{{url('admin/sinhvien')}}"><i class="fa fa-undo"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table comman-shadow">
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card-body">
                @if (session('status'))

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('status')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Sinh viên</h3>
                        </div>
                        <div class="">
                        <div class="col" style="margin-left: 39%;margin-top: 4%;">
                                <h6 style="vertical-align: inherit; color:blue; ">Form file mẫu:
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <form method="POST" enctype="multipart/form-data" action="{{ url('export-mausinhvien') }}">
                                            @csrf
                                            <input type="submit" value="Tải xuống " name="MauSinhvienExport" class=" btn-outline-primary" style="margin-left: -100%;"></input>
                                        </form>
                                    </div>
                                </h6>
                            </div>
                            <div class="form-group " style="margin-left: 39%; margin-top: -5%;">
                                <form method="POST" enctype="multipart/form-data" action="{{ url('import') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6" style="margin-top: -40px;">
                                            <div class="invoices-upload-btn">
                                                <input type="file" name="import_file">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="col-auto text-end float-end ms-auto download-grp " style="margin-left: 60%; margin-top: -35px; ">
                                                <button type="submit" name="import" value="" class="btn btn-outline-primary me-2"><i class="fa fa-upload"> Tải lên</i></button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp" style="margin-top: -66px; margin-right: 5%;">
                                <form method="POST" enctype="multipart/form-data" action="{{ url('export') }}">
                                    @csrf
                                    <input type="submit" value="Tải xuống " name="export" class="btn btn-outline-primary me-2" style="margin-left: -100%;"></input>
                                </form>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">

                                <a href="{{url('admin/sinhvien/create')}}" class="btn btn-primary" style="margin-left: -40%; margin-top: -120px; "><i class="fas fa-plus"></i></a>

                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('xoa-sinhvien') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="table-responsive " style="margin-top: -80px;">
                        <button onclick="return confirm('Bạn có muốn xóa sinh viên đã chọn hay không?')" class="btn btn-outline-primary me-2" type="submit">Xóa </button>
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="xoa_tat_ca" value="1">
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
                                    <th>Khóa học</th>
                                    <th>Trạng thái</th>
                                    <th>Ghi Chú</th>
                                    <th class="text-end">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sinhviens as $keys => $sinhvien)
                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="sinhvien_ids[]" value="{{ $sinhvien->id }}">
                                        </div>
                                    </td>
                                    <td>{{$sinhvien->soThuTu1}}</td>
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
                                    <td>{{$sinhvien->ghichu}}</td>
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
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
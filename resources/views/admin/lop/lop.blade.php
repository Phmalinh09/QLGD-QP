@extends('admin/layout')
@section('page_title','Lớp quản lý')
@section('lop_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Lớp quản lý</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="get">
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="form-group">
                    <input type="text" name="ma_lop" id="ma_lop" value="{{ request('ma_lop') }}" class="form-control" placeholder="Tìm kiếm theo mã lớp...">
                </div>
            </div>

            <div class="col-lg-4 col-md-1">
                <div class="form-group local-forms">

                    <select class="form-control select" name="khoa_ly" id="khoa_ly">
                        <option style="text-align: center;" value="">------- Tìm kiếm theo khoa --------</option>
                        @foreach ($khoas as $khoa)
                        <option value="{{ $khoa->id }}" {{ request('khoa_ly') == $khoa->id ? 'selected' : '' }}>
                            {{ $khoa->tenkhoa }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-1">
                <div class="form-group local-forms">
                    <select class="form-control select" name="khoa_hoc" id="khoa_hoc">
                        <option style="text-align: center;" value="">------- Tìm kiếm theo khóa học --------</option>
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
                    <a class="btn btn-primary" href="{{url('admin/lop')}}"><i class="fa fa-undo"></i></a>
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

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('status')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">LỚP QUẢN LÝ</h3>
                        </div>
                        <div>
                            <div class="col" style="margin-left: 39%;margin-top: 4%;">
                                <h6 style="vertical-align: inherit; color:blue; ">Form file mẫu:
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <form method="POST" enctype="multipart/form-data" action="{{ url('export-maulop') }}">
                                            @csrf
                                            <input type="submit" value="Tải xuống " name="MauLopExport" class=" btn-outline-primary" style="margin-left: -100%;"></input>
                                        </form>
                                    </div>
                                </h6>
                            </div>
                            <div class="form-group " style="margin-left: 39%; margin-top: -5%;">
                                <form method="POST" enctype="multipart/form-data" action="{{ url('import-lop') }}">
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
                                <form method="POST" enctype="multipart/form-data" action="{{ url('export-lop') }}">
                                    @csrf
                                    <input type="submit" value="Tải xuống " name="export" class="btn btn-outline-primary me-2" style="margin-left: -100%;"></input>
                                </form>
                            </div>

                            <div class="col-auto text-end float-end ms-auto download-grp">

                                <a href="{{url('admin/lop/create')}}" class="btn btn-primary" style="margin-left: -40%; margin-top: -120px; "><i class="fas fa-plus"></i></a>

                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('xoa-lop') }}" method="POST">
                    @method('DELETE')
                    @csrf

                    <div class="table-responsive " style="margin-top: -80px;">
                        <button onclick="return confirm('Bạn có muốn xóa lớp hay không?')" class="btn btn-outline-primary me-2" type="submit">Xóa </button>
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">

                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="xoa_tat_ca" value="1">
                                        </div>
                                    </th>
                                    <th>STT</th>
                                    <th>Mã lớp</th>
                                    <th>Tổng sinh viên</th>
                                    <th>Tổng nam</th>
                                    <th>Tổng nữ</th>
                                    <th>Khóa học</th>
                                    <th>Khoa</th>
                                    <th>Ngành</th>
                                    <th>Trạng thái</th>
                                    <th class="text-end">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lops as $lop)
                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input checkbox_ids" id="" type="checkbox" name="lop_ids[]" value="{{ $lop->id }}">
                                        </div>
                                    </td>
                                    <td>{{$lop->soThuTu1}}</td>
                                    <td>{{$lop->malop}}</td>
                                    <td>{{$lop->tong_sinhvien}}</td>
                                    <td>{{$lop->tong_nam}}</td>
                                    <td>{{$lop->tong_nu}}</td>
                                    <td>{{$lop->khoahocs->makhoahoc}}</td>
                                    <td>{{$lop->khoas->tenkhoa}}</td>
                                    <td>{{$lop->nganhs->tennganh}}</td>
                                    <td>
                                        @if($lop->trangthai==0)
                                        <span class="text text-success">kích hoạt</span>
                                        @else
                                        <span class="text text-danger">không kích hoạt</span>
                                        @endif
                                    </td>
                </form>
                <td class="text-end">
                    <div class="actions">
                        <!-- <a href="{{url('xem-lop/'.$lop->id)}}" class="btn btn-sm bg-success-light me-2 ">
                            <i class="feather-eye"></i>
                        </a> -->
                        <a href="{{url('them-sinhvien/'.$lop->id)}}" class="btn btn-sm bg-success-light me-2 ">
                            <i class="feather-eye"></i>
                        </a>
                        <a href="{{route('lop.edit',[$lop->id])}}" class="btn btn-sm bg-danger-light">
                            <i class="feather-edit"></i>
                        </a>

                        <form action="{{route('lop.destroy',[$lop->id])}}" method="POST" style="margin-top:-4px;">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Bạn có muốn xóa lớp hay không?')" class="btn btn-sm">
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
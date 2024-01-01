@extends('chuyenvien/layout1')
@section('page_title','Xem chi tiết đợt học')
@section('kehoach_select','active')
@section('phandot_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb" style="margin-right: 75%">
                <li class="breadcrumb-item"><a href="{{url('chuyenvien/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Chi tiết danh sách sinh viên {{$phanDots->dothocs->sodot}}</li>
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

            <div class="col-lg-2 col-md-1">
                <div class="form-group local-forms">

                    <select class="form-control select" name="lop_hoc" id="lop_hoc">
                        <option style="text-align: center;" value="">---- Tìm kiếm theo lớp ----</option>
                        @foreach ($lops as $lop)
                        <option value="{{ $lop->id }}" {{ request('lop_hoc') == $lop->id ? 'selected' : '' }}>
                            {{ $lop->malop }}
                        </option>
                        @endforeach
                    </select>


                </div>
            </div>
            <div class="col-lg-2 col-md-1">
                <div class="form-group local-forms">
                    <select class="form-control select" name="khoa_hoc" id="khoa_hoc">
                        <option style="text-align: center;" value="">-- Tìm kiếm theo khóa học --</option>
                        @foreach ($khoahocs as $khoahoc)
                        <option value="{{ $khoahoc->id }}" {{ request('khoa_hoc') == $khoahoc->id ? 'selected' : '' }}>
                            {{ $khoahoc->makhoahoc }}
                        </option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-md-1">
                <div class="form-group local-forms">
                    <select class="form-control select" name="trang_thai" id="trang_thai">
                        <option style="text-align: center;" value="">-- Trạng thái --</option>
                        <option value="Hoạt động">Hoạt động</option>
                        <option value="Không hoạt động">Không hoạt động</option>
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
                    <a class="btn btn-primary" href="{{url('chuyenvien/cvxem-dothoc/'.$phanDots->id)}}"><i class="fa fa-undo"></i></a>
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
                            <h3 class="page-title">Chi tiết danh sách sinh viên {{$phanDots->dothocs->sodot}} - Khóa {{$phanDots->khoahocs->makhoahoc}}</h3>
                        </div>

                    </div>
                </div>


                    <div class="table-responsive " style="margin-top: -10px;">
                       
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                            <thead class="student-thread">
                                <tr>

                                    <th>STT</th>
                                    <th>Mã HS-SV</th>
                                    <th>Họ đệm</th>
                                    <th>Tên</th>
                                    <th>Giới tính</th>
                                    <th>Ngày sinh</th>
                                    <th>Số điện thoại</th>
                                    <th>Lớp học</th>
                                    <th>Khóa học</th>
                                    <th>Số xe</th>
                                    <th>Số phòng</th>
                                    <th>Trạng thái   </th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sinhViens as $keys => $sinhvien)
                                <tr>

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
                                    <td>{{$sinhvien->soXeDaPhan}}</td>
                                    <td>{{$sinhvien->soPhongDaPhan}}</td>
                                    <!-- <td>
                                        @if($sinhvien->trangthai=='Hoạt động')
                                        <span class="text text-success">Hoạt động</span>
                                        @else
                                        <span class="text text-danger">Không hoạt động</span>
                                        @endif
                                    </td> -->
                                    <td>
                                        @if($sinhvien->trangthai=='Hoạt động')
                                        <span class="text text-success">Hoạt động</span>
                                        @else
                                        <span class="text text-danger">Không hoạt động</span>
                                        @endif
                                    </td>
                                    <td>{{$sinhvien->ghichu}}</td>
                                    
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
@extends('chuyenvien/layout1')
@section('page_title','Tổng quan')
@section('tongquan_select','active')
@section('container')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-sub-header" style="margin-right: auto;">
                <ul class="breadcrumb" style="margin-right: 85%">
                    <li class="breadcrumb-item"><a href="{{url('chuyenvien/tongquan')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Tổng quan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Tổng sinh viên</h6>
                        <h3>{{$sinhvienss}}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="../assets/img/icons/dash-icon-01.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Tổng số lớp</h6>
                        <h3>{{$lopss}}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="../assets/img/icons/teacher-icon-01.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Tổng số đợt học</h6>
                        <h3>{{$phandotss}}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="../assets/img/icons/student-icon-01.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Tổng số phòng ở</h6>
                        <h3>{{$phongss}}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="../assets/img/icons/dash-icon-03.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-5 col-md-1">
                <div class="form-group local-forms">
                    <select class="form-control select" name="khoahocstk" id="khoahocstk">
                        <option style="text-align: center;" value="">------- Tìm kiếm theo khóa học --------</option>
                        @foreach ($khoahocs as $khoahoc)
                        <option value="{{ $khoahoc->id }}" {{ request('khoahocs') == $khoahoc->id ? 'selected' : '' }}>
                            {{ $khoahoc->makhoahoc }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-5 col-md-1">
                <div class="form-group local-forms">
                    <select class="form-control select" name="dothocstk" id="dothocstk">
                        <option style="text-align: center;" value="">------- Tìm kiếm theo đợt học --------</option>
                        <!-- @foreach ($dothocs as $dothoc)
                        <option value="{{ $dothoc->id }}" {{ request('dothocs') == $dothoc->id ? 'selected' : '' }}>
                            {{ $dothoc->sodot }}
                        </option>
                        @endforeach -->
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
                    <a class="btn btn-primary" href="{{url('chuyenvien/tongquan')}}"><i class="fa fa-undo"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table comman-shadow">
            <div class="card-body">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">DANH SÁCH PHÂN ĐỢT HỌC</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive ">
                    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                        <thead class="student-thread">
                            <tr>
                                
                                <th>STT</th>
                                <th>Khóa học</th>
                                <th>Đợt học</th>

                                <th>Tổng sinh viên</th>
                                <th>Tổng nam</th>
                                <th>Tổng nữ</th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian kết thúc</th>
                                <th>Thầy/Cô phụ trách</th>
                                <th>Lớp</th>
                                <th>Khoa</th>
                                <th>Ghi chú</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hoạt động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($phandot as $keys => $phandots)
                            <tr>
                                
                                <td>{{$phandots->soThuTu1}}</td>
                                <td>{{$phandots->khoahocs->makhoahoc}}</td>
                                <td>{{$phandots->dothocs->sodot}}</td>

                                <td>{{$phandots->tong_sv}}</td>
                                <td>{{$phandots->tong_nam}}</td>
                                <td>{{$phandots->tong_nu}}</td>
                                <td>{{$phandots->tg_batdau}}</td>
                                <td>{{$phandots->tg_ketthuc}}</td>
                                <td width="10%">
                                    @if(count($phandots->giangvien))
                                    @foreach($phandots->giangvien as $giangviens)
                                    <a href="#" data-type="checklist" value="{{$giangviens->id}}" title="Select divisions" name="giangviens[]" class="giangviens" data-pk="{{$giangviens->id}}" role="button">
                                        <span class=" label-primary">{{$giangviens->tengv}}-{{$giangviens->sdt}}<br></span>
                                    </a>
                                    @endforeach
                                    @endif
                                </td>
                                <td width="10%">
                                    @if(count($phandots->lop))
                                    @foreach($phandots->lop as $lops)
                                    <a href="#" data-type="checklist" value="{{$lops->id}}" title="Select divisions" name="lops[]" class="lops" data-pk="{{$lops->id}}" role="button">
                                        <span class=" label-primary">{{$lops->malop}},</span>
                                    </a>
                                    @endforeach
                                    @endif
                                </td>
                                <td width="10%">
                                    @if(count($phandots->khoa))
                                    @foreach($phandots->khoa as $khoas)
                                    <a href="#" data-type="checklist" value="{{$khoas->id}}" title="Select divisions" name="khoas[]" class="khoas" data-pk="{{$khoas->id}}" role="button">
                                        <span class=" label-primary">{{$khoas->tenkhoa}},<br></span>
                                    </a>
                                    @endforeach
                                    @endif
                                </td>
                                <td>{{$phandots->ghichu}}</td>
                                <td>
                                    @if($phandots->trangthai==0)
                                    <span class="text text-success">kích hoạt</span>
                                    @else
                                    <span class="text text-danger">không kích hoạt</span>
                                    @endif
                                </td>
                                </form>
                                <td class="text-end">
                                    <div class="actions">
                                        <a href="{{url('chuyenvien/cvxem-dothoc/'.$phandots->id)}}" class="btn btn-sm bg-success-light me-2 ">
                                            <i class="feather-eye"></i>
                                        </a>

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
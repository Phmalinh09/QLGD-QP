@extends('chuyenvien/layout1')
@section('page_title','Phân phòng')

@section('kehoach_select','active')
@section('phanphong_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb" style="margin-right: 83%">
                <li class="breadcrumb-item"><a href="{{url('chuyenvien/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Phân phòng ở</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="form-group">
                    <input type="number" name="so_phong" id="so_phong" value="{{ request('so_phong') }}" class="form-control" placeholder="Tìm kiếm số phòng...">
                </div>
            </div>

            <div class="col-lg-3 col-md-3">
                <div class="form-group local-forms">
                    <select class="form-control select" name="dot_hoc" type="search">
                        <option style="text-align: center;" value="">---- Tìm kiếm đợt học --------</option>

                        @foreach($dothocs as $key =>$dothoc)
                        <option value="{{ $dothoc->id }}" {{ request('dot_hoc') == $dothoc->id ? 'selected' : '' }}>
                            {{ $dothoc->sodot }} - {{ $dothoc->khoahocs->makhoahoc }}
                        </option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="form-group">
                    <input type="text" name="ho_ten" id="ho_ten" value="{{ request('ho_ten') }}" class="form-control" placeholder="Tìm kiếm mã sv...">
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="form-group">
                    <input type="text" name="ms_sv" id="ms_sv" value="{{ request('ms_sv') }}" class="form-control" placeholder="Tìm kiếm tên sinh viên...">
                </div>
            </div>

            <div class="col-lg-1">
                <div class="search-student-btn">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
            <div class="col-lg-1">
                <div class="search-student-btn1">
                    <a class="btn btn-primary" href="{{url('chuyenvien/cvphanphong')}}"><i class="fa fa-undo"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('cvphanphong.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>PHÂN PHÒNG Ở</span></h5>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="khoahocs">Khóa học <span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoahocs" id="khoahocs" aria-label=".form-select-sm example">
                                    <option value="">Chọn khóa học</option>
                                    @foreach($khoahocs as $key =>$khoahoc)
                                    <option value="{{$khoahoc->id}}">{{$khoahoc->makhoahoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="dothocs">Chọn đợt học <span class="login-danger">*</span></label>
                                <select class="form-control select" value="" name="dothocs" id="dothocs" aria-label=".form-select-sm example">
                                </select>
                                @error('dothocs')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Giới tính <span class="login-danger">*</span></label>
                                <select class="form-control select" name="gioitinh" id="gioitinhs" aria-label=".form-select-sm example">
                                    <option value="">Chọn giới tính</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                                @error('gioitinh')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label for="phongs">Phòng ở <span class="login-danger">*</span></label>
                                <select class="form-control select" value="" name="phongs" id="phongs" aria-label=".form-select-sm example">
                                    <option value="">Chọn Phòng</option>
                                    @foreach($phongs as $key =>$phong)
                                    <option value="{{$phong->id}}">{{$phong->tenphong}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group row ">
                            <label class="col-form-label col-md-2" for=""><strong>Chọn số phòng </strong><span class="login-danger">*</span></label><br>
                            <div class="col-md-21 " id="phongs">
                            </div>
                            @error('phongs')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="student-submit">
                                <button type="submit" name="phandothoc" class="btn btn-primary">Lưu</button>
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
                            <h3 class="page-title">DANH SÁCH SINH VIÊN CHƯA ĐƯỢC PHÂN PHÒNG</h3>
                        </div>
                    </div>
                </div>
                @if(session('svChuaPhanPhong'))
                <div class="table-responsive ">
                    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                        <thead class="student-thread">
                            <tr>
                                <th>STT</th>
                                <th>Mã sinh viên</th>
                                <th>Họ</th>
                                <th>Tên</th>
                                <th>Lớp</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('svChuaPhanPhong') as $sinhVien)
                            <tr>
                                <td>{{ $sinhVien->soThuTu }}</td>
                                <td>{{ $sinhVien->mssv }}</td>
                                <td>{{ $sinhVien->hodem }}</td>
                                <td>{{ $sinhVien->ten }}</td>
                                <td>{{ $sinhVien->lops->malop }}</td>
                                <td>{{ $sinhVien->gioitinh }}</td>
                                <td>{{ $sinhVien->ngaysinh }}</td>
                                <td>
                                    @if($sinhVien->trangthai=='Hoạt động')
                                    <span class="text text-success">Hoạt động</span>
                                    @else
                                    <span class="text text-danger">Không hoạt động</span>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>Không có sinh viên chưa được phân phòng.</p>
                    @endif
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
                                <h3 class="page-title">DANH SÁCH PHÂN PHÒNG Ở</h3>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('cvxoa-phan-phong-o') }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="table-responsive ">
                            <button onclick="return confirm('Bạn có muốn xóa tất cả danh sách phòng ở hay không?')" class="btn btn-outline-primary  me-2" type="submit">Xóa </button>
                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                                <thead class="student-thread">
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" name="cvxoa_tat_ca_phan_phong" value="1">
                                            </div>
                                        </th>
                                        <th>STT</th>
                                        <th>Khóa học</th>
                                        <th>Đợt học</th>
                                        <th>Phòng ở</th>
                                        <th>Mã sinh viên</th>
                                        <th>Họ</th>
                                        <th>Tên</th>
                                        <th>Lớp</th>
                                        <th>Giới tính</th>
                                        <th>Ngày sinh</th>
                                        <th class="text-end">Hoạt động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($phanphongs as $keys => $phanphongss)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" name="cvphanphong_ids[]" value="{{ $phanphongss->id }}">
                                            </div>
                                        </td>
                                        <td>{{$phanphongss->soThuTu1}}</td>
                                        <td>{{$phanphongss->khoahocs->makhoahoc}}</td>
                                        <td>{{$phanphongss->dothocs->sodot}}</td>
                                        <td>{{$phanphongss->tenphong}}</td>
                                        <td>{{$phanphongss->mssv}}</td>
                                        <td>{{$phanphongss->hosv}}</td>
                                        <td>{{$phanphongss->tensv}}</td>
                                        <td>{{$phanphongss->lop_id}}</td>
                                        <td>{{$phanphongss->gioitinh}}</td>
                                        <td>{{$phanphongss->ngaysinh}}</td>
                    </form>
                    <td class="text-end">
                        <div class="actions">
                            <a href="" class="btn btn-sm bg-danger-light">
                                <i class="feather-edit"></i>
                            </a>

                            <form action="{{route('phanphong.destroy',[$phanphongss->id])}}" method="POST" style="margin-top:-4px;">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Bạn có muốn xóa  hay không?')" class="btn btn-sm">

                                    <a class="btn btn-sm  bg-danger-light text-danger"><i class="far fa-trash-alt me-1"></i></a>
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



    @endsection
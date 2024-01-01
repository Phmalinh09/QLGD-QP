@extends('admin/layout')
@section('page_title','Phân xe')

@section('kehoach_select','active')
@section('phanxe_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb" >
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Phân xe</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-2 col-md-6">
                <div class="form-group">
                    <input type="number" name="so_xe" id="so_xe" value="{{ request('so_xe') }}" class="form-control" placeholder="Tìm kiếm số xe...">
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
                    <input type="search" name="ms_sv" id="ms_sv" value="{{ request('ms_sv') }}" class="form-control" placeholder="Tìm kiếm mã sv...">
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="form-group">
                    <input type="search" name="ho_ten" id="ho_ten" value="{{ request('ho_ten') }}" class="form-control" placeholder="Tìm kiếm tên sinh viên...">
                </div>
            </div>
            <div class="col-lg-1">
                <div class="search-student-btn">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
            <div class="col-lg-1">
                <div class="search-student-btn1">
                    <a class="btn btn-primary" href="{{url('admin/phanxe')}}"><i class="fa fa-undo"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('phanxe.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>PHÂN XE</span></h5>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label for="khoahocs">Khóa học <span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoahocs" id="khoahocs" aria-label=".form-select-sm example">
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

                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label for="dothocs">Chọn đợt học <span class="login-danger">*</span></label>
                                <select class="form-control select" name="dothocs" id="dothocs" aria-label=".form-select-sm example">
                                </select>
                                @error('dothocs')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="student-submit">
                                <button type="submit" name="phanxe" class="btn btn-primary">Phân xe</button>
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
                            <h3 class="page-title">DANH SÁCH PHÂN XE</h3>
                        </div>
                        <form method="POST" enctype="multipart/form-data" action="{{ url('export-phanxe') }}">
                            @csrf
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <input type="submit" value="Tải xuống " name="export" class="btn btn-outline-primary me-2" style="margin-left: -100%;"></input>
                            </div>
                            <div class=" col-12 col-sm-2 float-end" style="margin-right: 1%;">
                                <div class=" local-forms">
                                    <label>Chọn đợt học <span class="login-danger">*</span></label>
                                    <select class="form-control select" name="dot_hocs" aria-label=".form-select-sm example">
                                        <option style="text-align: center;" value=""> Chọn đợt học</option>
                                        @foreach($dothocs as $key =>$dothoc)
                                        <option value="{{ $dothoc->id }}" {{ request('dot_hocs') == $dothoc->id ? 'selected' : '' }}>
                                            {{ $dothoc->sodot }} - {{ $dothoc->khoahocs->makhoahoc }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <form action="{{ route('xoa-phan-xe') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="table-responsive ">
                        <button onclick="return confirm('Bạn có muốn danh sách phân xe hay không?')" class="btn btn-outline-primary  me-2" type="submit">Xóa </button>
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="xoa_tat_ca_phan_xe" value="1">
                                        </div>
                                    </th>
                                    <th>STT</th>
                                    <th>Khóa học</th>
                                    <th>Đợt học</th>
                                    <th>Số xe</th>
                                    <th>Mã HS-SV</th>
                                    <th>Họ</th>
                                    <th>Tên</th>
                                    <th>Giới tính</th>
                                    <th>Ngày sinh</th>
                                    <th>Lớp</th>

                                    <th class="text-end">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($phanxe as $keys => $phandots)
                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="phanxe_ids[]" value="{{ $phandots->id }}">
                                        </div>
                                    </td>
                                    <td>{{$phandots->soThuTu1}}</td>
                                    <td>{{$phandots->khoahocs->makhoahoc}}</td>
                                    <td>{{$phandots->dothocs->sodot}}</td>
                                    <td>{{$phandots->so_xe}} </td>
                                    <td>{{$phandots->mssv}} </td>
                                    <td>{{$phandots->hosv}} </td>
                                    <td>{{$phandots->tensv}} </td>
                                    <td>{{$phandots->gioitinh}} </td>
                                    <td>{{$phandots->ngaysinh}} </td>
                                    <td>{{$phandots->lop_id}} </td>

                </form>
                <td class="text-end">
                    <div class="actions">
                        <form action="{{route('phanxe.destroy',[$phandots->id])}}" method="POST" style="margin-top:-4px;">
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
</div>
@endsection
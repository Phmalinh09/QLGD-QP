@extends('chuyenvien/layout1')
@section('page_title','Phòng ở')
@section('phong_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb" style="margin-right: 86%">
                <li class="breadcrumb-item"><a href="{{url('chuyenvien/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Phòng ở</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">
        <div class="col-lg-5 col-md-6">
                <div class="form-group">
                <input type="search" name="so_phong" id="so_phong" value="{{ request('so_phong') }}" class="form-control" placeholder="Tìm kiếm theo số phòng...">
                </div>
            </div>

            <div class="col-lg-5 col-md-1">
                <div class="form-group local-forms">
                    <select class="form-control select" name="gioi_tinh" id="gioi_tinh">
                        <option style="text-align: center;" value="">------- Tìm kiếm theo giới tính -------</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
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
                    <a class="btn btn-primary" href="{{url('chuyenvien/cvphong')}}"><i class="fa fa-undo"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('cvphong.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>THÊM PHÒNG Ở</span></h5>
                        </div>
                        
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Tên phòng <span class="login-danger">*</span></label>
                                <input type="text" class="form-control"  name="tenphong">
                                @error('tenphong')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Số chỗ <span class="login-danger">*</span></label>
                                <input type="number" class="form-control"  name="socho" value="8" readonly>
                                @error('socho')
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
                        
                        <div class="col-12 col-sm-2">
                            <div class="student-submit">
                                <button type="submit" name="themdothoc" class="btn btn-primary">Thêm</button>
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
                @if (session('status'))

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('status')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">QUẢN LÝ PHÒNG Ở</h3>
                        </div>

                    </div>
                </div>


                <form action="{{ route('cvxoa-phong-o') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="table-responsive ">
                        <button onclick="return confirm('Bạn có muốn xóa phòng ở này không?')"  class="btn btn-outline-primary  me-2" type="submit">Xóa </button>
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="cvxoa_tat_ca_phong_o" value="1">
                                        </div>
                                    </th>
                                    <th>STT</th>
                                    <th>Tên phòng</th>
                                    <th>Số chỗ</th>
                                    <th>Giới tính</th>
                                    <th class="text-end">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($phong as $keys => $phongs)
                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="cvphong_ids[]" value="{{ $phongs->id }}">
                                        </div>
                                    </td>
                                    <td>{{$phongs->soThuTu1}}</td>
                                    <td>{{$phongs->tenphong}}</td>
                                    <td>{{$phongs->socho}}</td>
                                    <td>{{$phongs->gioitinh}}</td>
                                </form>
                                    <td class="text-end">
                                        <div class="actions">
                                            <a href="{{route('cvphong.edit',[$phongs->id])}}" class="btn btn-sm bg-danger-light">
                                                <i class="feather-edit"></i>
                                            </a>

                                            <form action="{{route('cvphong.destroy',[$phongs->id])}}" method="POST" style="margin-top:-4px;">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn có muốn xóa phòng ở này không?')" class="btn btn-sm">
                                                    
                                                    <a class="btn btn-sm  bg-danger-light text-danger"  ><i class="far fa-trash-alt me-1"></i></a>
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
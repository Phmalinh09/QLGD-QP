@extends('admin/layout')
@section('page_title','Giảng viên')
@section('giangvien_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Giảng viên</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="form-group">
                <input type="search" name="ten_gv" id="ten_gv" value="{{ request('ten_gv') }}" class="form-control" placeholder="Tìm kiếm theo tên giảng viên...">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="form-group local-forms">
                    <select class="form-control select" name="trang_thai" id="trang_thai">
                        <option style="text-align: center;" value="">-- Trạng thái --</option>
                        <option value="0">Hoạt động</option>
                        <option value="1">Không hoạt động</option>
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
                    <a class="btn btn-primary" href="{{url('admin/giangvien')}}"><i class="fa fa-undo"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('giangvien.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Thêm giáo viên</span></h5>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Tên giảng viên <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('tengv')}}" name="tengv">
                                @error('tengv')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Email <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('email')}}" name="email">
                                @error('email')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Số điện thoại <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('sdt')}}" name="sdt">
                                @error('sdt')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Trạng thái <span class="login-danger">*</span></label>
                                <select class="form-control select" name="trangthai" aria-label=".form-select-sm example">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="student-submit">
                                <button type="submit" name="themgiangvien" class="btn btn-primary">Thêm</button>
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
                            <h3 class="page-title">Giảng viên</h3>
                        </div>
                        <!-- <div class="col-auto text-end float-end ms-auto download-grp">

                            <a href="{{url('admin/giangvien/create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                        </div> -->
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                        <thead class="student-thread">
                            <tr>
                                <th>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something">
                                    </div>
                                </th>
                                <th>STT</th>
                                <th>Tên giảng viên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hoạt động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($giangvien as $keys => $giangviens)
                            <tr>
                                <td>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something">
                                    </div>
                                </td>
                                <td>{{$giangviens->id}}</td>
                                <td>
                                    <h2>
                                        <a>{{$giangviens->tengv}}</a>
                                    </h2>
                                </td>
                                <td>{{$giangviens->email}}</td>
                                <td>{{$giangviens->sdt}}</td>
                                <td>
                                    @if($giangviens->trangthai==0)
                                    <span class="text text-success">kích hoạt</span>
                                    @else
                                    <span class="text text-danger">không kích hoạt</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="actions">
                                        <a href="{{route('giangvien.edit',[$giangviens->id])}}" class="btn btn-sm bg-danger-light">
                                            <i class="feather-edit"></i>
                                        </a>

                                        <form action="{{route('giangvien.destroy',[$giangviens->id])}}" method="POST" style="margin-top:-4px;">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa giảng viên truyện hay không?')" class="btn btn-sm">
                                                <a class="btn btn-sm bg-danger-light"><i class="fa fa-trash"></i></a>
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
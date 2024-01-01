@extends('admin/layout')
@section('page_title','Khóa học')
@section('khoahoc_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb" >
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Khóa học</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('khoahoc.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>THÊM KHÓA HỌC</span></h5>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Khóa học <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('makhoahoc')}}" name="makhoahoc">
                                @error('makhoahoc')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Năm <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('nam')}}" name="nam">
                                @error('nam')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12 col-sm-4">
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
                                <button type="submit" name="themkhoahoc" class="btn btn-primary">Thêm</button>
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
                            <h3 class="page-title">KHÓA HỌC</h3>
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
                                <th>Khóa học</th>
                                <th>Năm</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hoạt động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($khoahoc as $keys => $khoahocs)
                            <tr>
                                <td>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something">
                                    </div>
                                </td>
                                <td>{{$khoahocs->makhoahoc}}</td>
                                <td>
                                    <h2>
                                        <a>{{$khoahocs->nam}}</a>
                                    </h2>
                                </td>

                                <td>
                                    @if($khoahocs->trangthai==0)
                                    <span class="text text-success">kích hoạt</span>
                                    @else
                                    <span class="text text-danger">không kích hoạt</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="actions">
                                        <a href="{{route('khoahoc.edit',[$khoahocs->id])}}" class="btn btn-sm bg-danger-light">
                                            <i class="feather-edit"></i>
                                        </a>

                                        <form action="{{route('khoahoc.destroy',[$khoahocs->id])}}" method="POST" style="margin-top:-4px;">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có chắc muốn xóa khóa học này hay không? Nếu xóa khóa học này. Những dữ liệu liên quan đến khóa học này cũng bị xóa.?')" class="btn btn-sm">
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
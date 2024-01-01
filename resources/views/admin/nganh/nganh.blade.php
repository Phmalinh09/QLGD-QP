@extends('admin/layout')
@section('page_title','Thêm ngành đào tạo')
@section('nganh_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb" >
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Ngành đào tạo</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">

            <div class="col-lg-5 col-md-6">
                <div class="form-group">
                    <input type="search" name="manganh" class="form-control" placeholder="Tìm kiếm theo mã...">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="form-group">
                    <input type="search" name="tennganh" class="form-control" placeholder="Tìm kiếm theo tên...">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="search-student-btn">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-sm-12">
        <div class="card">

            <div class="card-body">
                <form method="POST" action="{{route('nganh.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Thêm ngành đào tạo</span></h5>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Mã ngành đào tạo <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('manganh')}}" name="manganh">
                                @error('manganh')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Tên ngành đào tạo <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('tennganh')}}" name="tennganh">
                                @error('tennganh')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Khoa <span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoas" aria-label=".form-select-sm example">
                                    @foreach($khoas as $key =>$khoa)
                                    <option value="{{$khoa->id}}">{{$khoa->tenkhoa}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-2">
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
                                <button type="submit" name="themhinhthucdaotao" class="btn btn-primary">Thêm</button>
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
                            <h3 class="page-title">Ngành đào tạo</h3>
                        </div>
                        <!-- <div class="col-auto text-end float-end ms-auto download-grp">
                            <a href="{{url('admin/nganh/create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                                <th>Mã ngành đào tạo</th>
                                <th>Tên ngành đào tạo</th>
                                <th>Khoa quản lý</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hoạt động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nganh as $keys => $nganhs)
                            <tr>
                                <td>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something">
                                    </div>
                                </td>
                                <td>{{$nganhs->id}}</td>
                                <td>{{$nganhs->manganh}}</td>

                                <td>
                                    <h2>
                                        <a>{{$nganhs->tennganh}}</a>
                                    </h2>
                                </td>
                                <td>{{$nganhs->khoas->tenkhoa}}</td>
                                <td>
                                    @if($nganhs->trangthai==0)
                                    <span class="text text-success">kích hoạt</span>
                                    @else
                                    <span class="text text-danger">không kích hoạt</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="actions">
                                        <a href="{{route('nganh.edit',[$nganhs->id])}}" class="btn btn-sm bg-danger-light">
                                            <i class="feather-edit"></i>
                                        </a>

                                        <form action="{{route('nganh.destroy',[$nganhs->id])}}" method="POST" style="margin-top:-4px;">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốn xóa ngành hay không?')" class="btn btn-sm">
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
@extends('admin/layout')
@section('page_title','Khoa')
@section('khoa_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb" >
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Khoa</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">

            <div class="col-lg-5 col-md-6">
                <div class="form-group">
                    <input type="search" name="makhoa" class="form-control" placeholder="Tìm kiếm theo mã khoa ...">
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="form-group">
                    <input type="search" name="tenkhoa" class="form-control" placeholder="Tìm kiếm theo tên khoa...">
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
        <div class="card card-table comman-shadow">
            <div class="card-body">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Khoa</h3>
                        </div>
                        <div class="col-auto text-end float-end ms-auto download-grp">

                                <a href="{{url('admin/khoa/create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>

                            </div>
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
                                <th>Mã khoa</th>
                                <th>Tên khoa</th>
                                <th>Trưởng khoa</th>
                                <th>Ngày thành lập</th>
                                <th>Mô tả Ngắn</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hoạt động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($khoa as $keys => $khoas)
                            <tr>
                                <td>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something">
                                    </div>
                                </td>
                                <td>{{$khoas->makhoa}}</td>
                                <td>
                                    <h2>
                                        <a>{{$khoas->tenkhoa}}</a>
                                    </h2>
                                </td>
                                <td>{{$khoas->truongkhoa}}</td>
                                <td>{{$khoas->ngaythanhlap}}</td>
                                <td>{{$khoas->mota}}</td>
                                <td>
                                    @if($khoas->trangthai==0)
                                    <span class="text text-success">kích hoạt</span>
                                    @else
                                    <span class="text text-danger">không kích hoạt</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="actions">
                                        <a href="{{route('khoa.edit',[$khoas->id])}}" class="btn btn-sm bg-danger-light">
                                            <i class="feather-edit"></i>
                                        </a>
                                        <!-- <form action="{{route('khoa.destroy',[$khoas->id])}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button onclick="return confirm('Bạn có muốnn xóa khoa truyện hay không?')" class="btn btn-sm bg-danger-light">
                                                        <a class="btn btn-sm bg-danger-light"><i class="fa fa-trash"></i></a>
                                                    </button>
                                                    </form> -->
                                        <form action="{{route('khoa.destroy',[$khoas->id])}}" method="POST" style="margin-top:-4px;">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Bạn có muốnn xóa khoa truyện hay không?')" class="btn btn-sm">
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
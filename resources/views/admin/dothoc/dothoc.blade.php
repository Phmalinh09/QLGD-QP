@extends('admin/layout')
@section('page_title','Đợt học')
@section('dothoc_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Đợt học</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-5 col-md-6">
            <div class="form-group">
                    <input type="search" name="dot_hoc" id="dot_hoc" value="{{ request('dot_hoc') }}" class="form-control" placeholder="Tìm kiếm theo đợt học...">
                </div>
            </div>

            <div class="col-lg-5 col-md-1">
                <div class="form-group local-forms">
                    <select class="form-control select" name="khoa_hoc" id="khoa_hoc">
                        <option style="text-align: center;" value="">--- Tìm kiếm theo khóa học ---</option>
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
                    <a class="btn btn-primary" href="{{url('admin/dothoc')}}"><i class="fa fa-undo"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('dothoc.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>THÊM ĐỢT HỌC</span></h5>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Khóa học <span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoahocs" aria-label=".form-select-sm example">
                                    @foreach($khoahocs as $key =>$khoahoc)
                                    <option value="{{$khoahoc->id}}">{{$khoahoc->makhoahoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Số đợt cần thêm <span class="login-danger">*</span></label>
                                <input type="number" class="form-control" name="so_luong">
                                <span class="form-text text-muted">Ví dụ: Thêm 8 đợt : 8</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Bổ sung thêm đợt <span class="login-danger">*</span></label>
                                <input type="number" class="form-control"  name="sodot">
                                <span class="form-text text-muted">Ví dụ: Bổ sung thêm 1 đợt : Đợt 1</span>
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
                            <h3 class="page-title">QUẢN LÝ ĐỢT HỌC</h3>
                        </div>

                    </div>
                </div>


                <form action="{{ route('xoa-dot-hoc') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="table-responsive ">
                        <button onclick="return confirm('Bạn có chắc muốn xóa đợt học này hay không? Nếu xóa đợt học này. Những dữ liệu liên quan đến đợt học này cũng bị xóa.')"  class="btn btn-outline-primary  me-2" type="submit">Xóa </button>
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="xoa_tat_ca" value="1">
                                        </div>
                                    </th>
                                    <th>STT</th>
                                    <th>Khóa học</th>
                                    <th>Đợt học</th>
                                    <th>Trạng thái</th>
                                    <th class="text-end">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dothoc as $keys => $dothocs)
                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="dothoc_ids[]" value="{{ $dothocs->id }}">
                                        </div>
                                    </td>
                                    <td>{{$dothocs->id}}</td>
                                    <td>{{$dothocs->khoahocs->makhoahoc}}</td>
                                    <td>{{$dothocs->sodot}}</td>

                                    <td>
                                        @if($dothocs->trangthai==0)
                                        <span class="text text-success">kích hoạt</span>
                                        @else
                                        <span class="text text-danger">không kích hoạt</span>
                                        @endif
                                    </td>
                                </form>
                                    <td class="text-end">
                                        <div class="actions">
                                            <a href="{{route('dothoc.edit',[$dothocs->id])}}" class="btn btn-sm bg-danger-light">
                                                <i class="feather-edit"></i>
                                            </a>

                                            <form action="{{route('dothoc.destroy',[$dothocs->id])}}" method="POST" style="margin-top:-4px;">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn có chắc muốn xóa đợt học này hay không? Nếu xóa đợt học này. Những dữ liệu liên quan đến đợt học này cũng bị xóa.')" class="btn btn-sm">
                                                    
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
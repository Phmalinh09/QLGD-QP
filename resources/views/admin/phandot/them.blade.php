@extends('admin/layout')
@section('page_title','Phân đợt học')
@section('phandot_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">THÊM ĐỢT HỌC</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/dothoc')}}">Danh sách phân đợt</a></li>
                <li class="breadcrumb-item active">Phân đợt học</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{route('phandot.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>PHÂN ĐỢT HỌC</span></h5>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Khóa học <span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoahocs" aria-label=".form-select-sm example">
                                    @foreach($khoahocs as $key =>$khoahoc)
                                    <option value="{{$khoahoc->id}}">{{$khoahoc->makhoahoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Chọn đợt học <span class="login-danger">*</span></label>
                                <select class="form-control select" name="dothocs" aria-label=".form-select-sm example">
                                    @foreach($dothocs as $key =>$dothoc)
                                    <option value="{{$dothoc->id}}">{{$dothoc->sodot}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Tổng sinh viên <span class="login-danger">*</span></label>
                                <input type="text" class="form-control"  name="tong_sv">
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Tổng nam <span class="login-danger">*</span></label>
                                <input type="text" class="form-control"  name="tong_nam">
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Tổng nữ <span class="login-danger">*</span></label>
                                <input type="text" class="form-control"  name="tong_nu">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms calendar-icon">
                                <label>Thời gian bắt đầu <span class="login-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" value="{{old('tg_batdau')}}" name="tg_batdau" placeholder="DD-MM-YYYY">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms calendar-icon">
                                <label>Thời gian kết thúc <span class="login-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" value="{{old('tg_ketthuc')}}" name="tg_ketthuc" placeholder="DD-MM-YYYY">
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Chọn khoa <span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoas" aria-label=".form-select-sm example">
                                    @foreach($khoas as $key =>$khoa)
                                    <option value="{{$khoa->id}}">{{$khoa->tenkhoa}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms">
                                <label>Chọn lớp <span class="login-danger">*</span></label>
                                <select class="form-control select" name="lops" aria-label=".form-select-sm example">
                                    @foreach($lops as $key =>$lop)
                                    <option value="{{$lop->id}}">{{$lop->malop}}</option>
                                    @endforeach
                                </select>
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
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Ghi chú<span class="login-danger">*</span></label>
                                <textarea class="form-control" type="text" class="form-control" value="{{old('ghichu')}}" name="ghichu" id="" cols="30" rows="10" style="resize: none;"></textarea>
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
@endsection
@extends('admin/layout')
@section('page_title','Chỉnh sửa phân đợt học')
@section('phandot_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">CHỈNH SỬA ĐỢT HỌC</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/phandot')}}">Danh sách phân đợt</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa phân đợt học</li>
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
                <form method="POST" action="{{route('phandot.update',[$phandots->id])}}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Khóa học<span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoahocs" aria-label=".form-select-sm example">
                                    @foreach($khoahocs as $key =>$khoahoc)
                                    <option {{$khoahoc->id==$phandots->khoahoc_id ? 'selected' : ''}} value="{{$khoahoc->id}}">{{$khoahoc->makhoahoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Chọn đợt học<span class="login-danger">*</span></label>
                                <select class="form-control select" name="dothocs" aria-label=".form-select-sm example">
                                    @foreach($dothocs as $key =>$dothoc)
                                    <option {{$dothoc->id==$phandots->dothoc_id ? 'selected' : ''}} value="{{$dothoc->id}}">{{$dothoc->sodot}}-{{$dothoc->khoahocs->makhoahoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms calendar-icon">
                                <label>Thời gian bắt đầu <span class="login-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" value="{{$phandots->tg_batdau}}" name="tg_batdau" placeholder="DD-MM-YYYY">
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms calendar-icon">
                                <label>Thời gian kết thúc <span class="login-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" value="{{$phandots->tg_ketthuc}}" name="tg_ketthuc" placeholder="DD-MM-YYYY">
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Trạng thái <span class="login-danger">*</span></label>
                                <select class="form-control select" name="trangthai" aria-label=".form-select-sm example">
                                    @if($phandots->trangthai==0)
                                    <option selected value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                    @else
                                    <option value="0">Kích hoạt</option>
                                    <option selected value="1">Không kích hoạt</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2"><strong>Chọn khoa quản lý </strong><span class="login-danger">*</span></label><br>
                            <div class="col-md-4">
                                @foreach($khoas->take(6) as $key =>$khoa)
                                <div class="checkbox">
                                    <label class="form-check-label" for="khoas_{{$khoa->id}}">
                                        <input class="form-check-input" type="checkbox" name="khoas[]" id="{{$khoa->id}}" {{ in_array($khoa->id, $nhieukhoa) ? 'checked' : '' }} value="{{$khoa->id}}">  {{$khoa->makhoa}} - {{$khoa->tenkhoa}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                @foreach($khoas->slice(6) as $key =>$khoa)
                                <div class="checkbox">
                                    <label class="form-check-label" for="khoas_{{$khoa->id}}">
                                        <input class="form-check-input" type="checkbox" name="khoas[]" id="{{$khoa->id}}" {{ in_array($khoa->id, $nhieukhoa) ? 'checked' : '' }} value="{{$khoa->id}}"> {{$khoa->makhoa}} - {{$khoa->tenkhoa}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-form-label col-md-2" for=""><strong>Chọn lớp quản lý </strong><span class="login-danger">*</span></label><br>
                        
                            @foreach($columns as $column)
                            <div class="col-md-22">
                                @foreach($column as $key =>$lop)
                                <div class="checkbox">
                                    <label class="form-check-label" for="lops_{{$lop->id}}">
                                        <input class="form-check-input" type="checkbox" name="lops[]" id="{{$lop->id}}" {{ in_array($lop->id, $nhieulop) ? 'checked' : '' }} value="{{$lop->id}}"> {{$lop->malop}} - {{$lop->khoas->makhoa}} - {{$lop->khoahocs->makhoahoc}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-2"><strong>Chọn giảng viên phụ trách</strong><span class="login-danger">*</span></label><br>
                            <div class="col-md-4">
                            @foreach($giangviens->take(6) as $key =>$giangvien)
                                <div class="checkbox">
                                    <label class="form-check-label" for="giangviens{{$giangvien->id}}">
                                        <input class="form-check-input" type="checkbox" name="giangviens[]" id="{{$giangvien->id}}" {{ in_array($giangvien->id, $nhieugiangvien) ? 'checked' : '' }} value="{{$giangvien->id}}">  {{$giangvien->tengv}} - {{$giangvien->sdt}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                            @foreach($giangviens->slice(6) as $key =>$giangvien)
                                <div class="checkbox">
                                    <label class="form-check-label" for="giangviens{{$giangvien->id}}">
                                        <input class="form-check-input" type="checkbox" name="giangviens[]" id="{{$giangvien->id}}" {{ in_array($giangvien->id, $nhieugiangvien) ? 'checked' : '' }} value="{{$giangvien->id}}"> {{$giangvien->tengv}} - {{$giangvien->sdt}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Ghi chú<span class="login-danger">*</span></label>
                                <textarea class="form-control" type="text" class="form-control" value="{{$phandots->ghichu}}" name="ghichu" id="" cols="30" rows="10" style="resize: none;"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="student-submit">
                                <button type="submit" name="themdothoc" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
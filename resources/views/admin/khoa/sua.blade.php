@extends('admin/layout')
@section('page_title','Chỉnh sửa thông tin khoa')
@section('khoa_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">CHỈNH SỬA KHOA</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/khoa')}}">Khoa</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa khoa</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">

            <div class="card-body">
                <form method="POST" action="{{route('khoa.update',[$khoas->id])}}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Mã khoa <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="makhoa" value="{{$khoas->makhoa}}">
                                @error('makhoa')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Tên khoa <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$khoas->tenkhoa}}" id="slug" onkeyup="ChangeToSlug();" name="tenkhoa">
                                @error('tenkhoa')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Trưởng khoa <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$khoas->truongkhoa}}" name="truongkhoa">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms calendar-icon">
                                <label>Ngày thành lập <span class="login-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" value="{{$khoas->ngaythanhlap}}" name="ngaythanhlap" placeholder="DD-MM-YYYY">
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Trạng thái <span class="login-danger">*</span></label>
                                <select class="form-control select" name="trangthai" aria-label=".form-select-sm example">
                                    @if($khoas->trangthai==0)
                                    <option selected value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                    @else
                                    <option value="0">Kích hoạt</option>
                                    <option selected value="1">Không kích hoạt</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-group local-forms">
                                <label>Mô tả ngắn<span class="login-danger">*</span></label>
                                <textarea class="form-control" type="text" class="form-control" name="mota" id="" cols="30" rows="10" style="resize: none;">{{$khoas->mota}}</textarea>
                                @error('mota')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="student-submit">
                                <button type="submit" name="themkhoa" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
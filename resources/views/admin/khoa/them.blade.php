@extends('admin/layout')
@section('page_title','Thêm khoa')
@section('khoa_select','active')
@section('container')

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">THÊM KHOA</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/khoa')}}">Khoa</a></li>
                <li class="breadcrumb-item active">Thêm khoa</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">           
            <div class="card-body">
                <form method="POST" action="{{route('khoa.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Mã khoa <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('makhoa')}}" name="makhoa">
                                @error('makhoa')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Tên khoa <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('tenkhoa')}}" name="tenkhoa" onkeyup="ChangeToSlug();" id="slug">
                                @error('tenkhoa')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Slug khoa <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('slug_khoa')}}" name="slug_khoa" id="convert_slug">
                            </div>
                        </div> -->
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Trưởng khoa </label>
                                <input type="text" class="form-control" value="{{old('truongkhoa')}}" name="truongkhoa">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms calendar-icon">
                                <label>Ngày thành lập </label>
                                <input class="form-control datetimepicker" type="text" value="{{old('ngaythanhlap')}}" name="ngaythanhlap" placeholder="DD-MM-YYYY">
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
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Mô tả ngắn</label>
                                <textarea class="form-control" type="text" class="form-control" value="{{old('mota')}}" name="mota" id="" cols="30" rows="10" style="resize: none;"></textarea>
                                @error('mota')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" name="themkhoa" class="btn btn-primary">Thêm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
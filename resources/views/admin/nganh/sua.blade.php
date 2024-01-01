@extends('admin/layout')
@section('page_title','Chỉnh sửa ngành đào tạo')
@section('nganh_select','active')
@section('container')

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">CHỈNH SỬA NGÀNH ĐÀO TẠO</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/nganh')}}">Ngành đào tạo</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa ngành đào tạo</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">

            <div class="card-body">
                <form method="POST" action="{{route('nganh.update',[$nganhs->id])}}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Mã ngành đào tạo <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="manganh" value="{{$nganhs->manganh}}">
                                @error('manganh')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Tên ngành đào tạo <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" name="tennganh" value="{{$nganhs->tennganh}}">
                                @error('tennganh')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label>Khoa<span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoas" aria-label=".form-select-sm example">
                                    @foreach($khoas as $key =>$khoa)
                                    <option {{$khoa->id==$nganhs->khoa_id ? 'selected' : ''}} value="{{$khoa->id}}">{{$khoa->tenkhoa}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Trạng thái <span class="login-danger">*</span></label>
                                <select class="form-control select" name="trangthai" aria-label=".form-select-sm example">
                                    @if($nganhs->trangthai==0)
                                    <option selected value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                    @else
                                    <option value="0">Kích hoạt</option>
                                    <option selected value="1">Không kích hoạt</option>
                                    @endif
                                </select>
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
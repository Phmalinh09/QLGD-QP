@extends('admin/layout')
@section('page_title','Thêm ngành đào tạo')
@section('nganh_select','active')
@section('container')

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">THÊM NGÀNH ĐÀO TẠO</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/tongquan')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/nganh')}}">Ngành đào tạo</a></li>
                <li class="breadcrumb-item active">Thêm ngành đào tạo</li>
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
                <form method="POST" action="{{route('nganh.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Chi tiết</span></h5>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group local-forms">
                                <label>Mã ngành đào tạo <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('manganh')}}" name="manganh">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group local-forms">
                                <label>Tên ngành đào tạo <span class="login-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('tennganh')}}" name="tennganh">
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

                        <div class="col-12 col-sm-6">
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

@endsection
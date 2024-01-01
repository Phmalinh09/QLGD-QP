@extends('chuyenvien/layout1')
@section('page_title','Thông tin tài khoản')
@section('container')

<div class="page-header">
    <div class="row">
        <div class="col">
            <h3 class="page-title">THÔNG TIN TÀI KHOẢN</h3>
            <ul class="breadcrumb1">
                <li class="breadcrumb-item"><a href="{{url('chuyenvien/tongquan1')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Thông tin</li>
            </ul>
        </div>
    </div>
</div>

<div class="row">
   

        <div class="">
            <div class="tab-pane fade show active" id="per_details_tab">

                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">

                                <h5 class="card-title d-flex justify-content-between mb-sm-5">
                                    <span>Thông tin cá nhân</span>
                                    <a class="edit-link" data-bs-toggle="" href="{{route('chuyenvien.edit.profile')}}"><i class="far fa-edit me-1"></i>Sửa</a>
                                </h5>

                                <div class=" row" style="width: 100%">
                                    <div class="col-md-2" style="width: 30%">
                                        <img class="rounded-circle" alt="User Image" width="200" height="250"  src="{{(!empty($adminData->hinhanh))? url('upload/admin_image/'.$adminData->hinhanh):url('upload/admin_image/images.png')}}">
                                    </div>

                                    <div class="" style="width: 70%">
                                        <div class="form-group row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Họ tên</p>
                                            <p class="col-sm-9">{{$adminData->name}}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Vai trò</p>
                                            <p class="col-sm-9">{{$adminData->vaitro}}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Ngày sinh</p>
                                            <p class="col-sm-9">{{$adminData->ngaysinh}}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email</p>
                                            <p class="col-sm-9"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a1cbcec9cfc5cec4e1c4d9c0ccd1cdc48fc2cecc">{{$adminData->email}}</a></p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Số điện thoại</p>
                                            <p class="col-sm-9">{{$adminData->sdt}}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Địa chỉ</p>
                                            <p class="col-sm-9 mb-0">{{$adminData->diachi}}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Ngày thêm</p>
                                            <p class="col-sm-9 mb-0">{{$adminData->created_at}}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Ngày sửa đổi</p>
                                            <p class="col-sm-9 mb-0">{{$adminData->updated_at}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">
                                    <span>Trạng thái tài khoản</span>
                                    <a class="edit-link" href="#"><i class="far fa-edit me-1"></i> Sửa</a>
                                </h5>
                                <button class="btn btn-success" type="button"><i class="fe fe-check-verified"></i> Hoạt động</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between">
                                    <span>Quyền quản lý </span>
                                    <a class="edit-link" href="#"><i class="far fa-edit me-1"></i> Sửa</a>
                                </h5>
                                <div class="skill-tags">
                                    <span>Quản lý phòng ở</span>
                                    <span>Phân phòng ở</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="password_tab" class="tab-pane fade">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Đổi mật khẩu</h5>
                        <div class="row">
                            <div class="col-md-10 col-lg-6">
                                <form wire:submit.prevent='updatePassword()'>

                                    <div class="form-group">
                                        <label>Mật khẩu cũ</label>
                                        <input type="password" class="form-control" wire:model.defer='current_password'>
                                        @error('current_password')
                                        <div class="d-block text-danger" style="margin-top: 25px; margin-bottom:15px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Mật khẩu mới</label>
                                        <input type="password" class="form-control" wire:model.defer='new_password'>
                                        @error('new_password')
                                        <div class="d-block text-danger" style="margin-top: 25px; margin-bottom:15px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Xác nhận mật khẩu</label>
                                        <input type="password" class="form-control" wire:model.defer='new_password_confi'>
                                        @error('new_password_confi')
                                        <div class="d-block text-danger" style="margin-top: 25px; margin-bottom:15px;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
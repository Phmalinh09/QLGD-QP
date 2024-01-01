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
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between mb-sm-3">
                                <span>Chỉnh sửa thông tin cá nhân</span>
                                <a class="edit-link" data-bs-toggle="" href="{{route('chuyenvien.profile')}}"><i class="fas fa-reply-all"></i> Quay lại</a>
                            </h5>
                            <form action="{{route('chuyenvien.store.profile')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class=" row" style="width: 100%">
                                    <div class="col-md-2" style="width: 5%">
                                        <img id="showImage" class="rounded-circle" width="200" height="250" alt="User Image" src="{{(!empty($editData->hinhanh))? url('upload/admin_image/'.$editData->hinhanh):url('upload/admin_image/images.png')}}">
                                    </div>
                                    <div class="" style="width: 95%">
                                        <div class="form-group row">
                                            <label class="col-sm-5 text-muted text-sm-end mb-0 mb-sm-3">Hình ảnh</label>
                                            <div class="col-md-5">
                                                <input type="file" name="hinhanh" value="" class="form-control" id="image">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-5 text-muted text-sm-end mb-0 mb-sm-3">Họ tên</label>
                                            <div class="col-md-5">
                                                <input type="text" value="{{$editData->name}}" name="name" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <p class="col-sm-5 text-muted text-sm-end mb-0 mb-sm-3">Ngày sinh</p>
                                            <div class="col-md-5">
                                                <input type="text" value="{{$editData->ngaysinh}}" name="ngaysinh" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <p class="col-sm-5 text-muted text-sm-end mb-0 mb-sm-3">Email</p>
                                            <p class="col-sm-5"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a1cbcec9cfc5cec4e1c4d9c0ccd1cdc48fc2cecc">{{$editData->email}}</a></p>
                                        </div>
                                        <div class="form-group row">
                                            <p class="col-sm-5 text-muted text-sm-end mb-0 mb-sm-3">Số điện thoại</p>
                                            <div class="col-md-5">
                                                <input type="text" value="{{$editData->sdt}}" name="sdt" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <p class="col-sm-5 text-muted text-sm-end mb-0 mb-sm-3">Địa chỉ</p>
                                            <div class="col-md-5">
                                                <input type="text" value="{{$editData->diachi}}" name="diachi" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <p class="col-sm-5 text-muted text-sm-end mb-0 mb-sm-3">Ngày thêm</p>
                                            <div class="col-md-5">
                                                <input type="text" value="{{$editData->created_at}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <p class="col-sm-5 text-muted text-sm-end mb-0 mb-sm-3">Ngày sửa đổi</p>
                                            <div class="col-md-5">
                                                <input type="text" value="{{$editData->updated_at}}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="col-sm-61 text-muted text-sm-end mb-0 mb-sm-3 student-submit">
                                                <button type="submit" id="type-success" name="themsinhvien" width="10" class="btn btn-primary">Sửa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between">
                                <span>Đổi mật khẩu</span>

                            </h5>
                            <div class="row">
                                <div class="col-md-10 col-lg-12">
                                    <form action="{{route('chuyenvien.update-password')}}" method="post">
                                        @csrf

                                        <div class="form-group">
                                            <label>Mật khẩu cũ</label>
                                            <input type="password" class="form-control" name="current_password" id="current_password">
                                            @error('current_password')
                                            <div class="d-block text-danger" style="margin-top: 25px; margin-bottom:15px;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Mật khẩu mới</label>
                                            <input type="password" class="form-control" name="new_password" id="new_password">
                                            @error('new_password')
                                            <div class="d-block text-danger" style="margin-top: 25px; margin-bottom:15px;">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Xác nhận mật khẩu</label>
                                            <input type="password" class="form-control" name="new_password_confi" id="new_password_confi">
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
</div>
</div>

@endsection
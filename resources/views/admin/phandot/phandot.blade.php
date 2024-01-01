@extends('admin/layout')
@section('page_title','Phân đợt học')

@section('kehoach_select','active')
@section('phandot_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Phân đợt học</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-5 col-md-1">
                <div class="form-group local-forms">
                    <select class="form-control select" name="khoahocstk" id="khoahocstk">
                        <option style="text-align: center;" value="">------- Tìm kiếm theo khóa học --------</option>
                        @foreach ($khoahocs as $khoahoc)
                        <option value="{{ $khoahoc->id }}" {{ request('khoahocs') == $khoahoc->id ? 'selected' : '' }}>
                            {{ $khoahoc->makhoahoc }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-5 col-md-1">
                <div class="form-group local-forms">
                    <select class="form-control select" name="dothocstk" id="dothocstk">
                        <option style="text-align: center;" value="">------- Tìm kiếm theo đợt học --------</option>
                        <!-- @foreach ($dothocs as $dothoc)
                        <option value="{{ $dothoc->id }}" {{ request('dothocs') == $dothoc->id ? 'selected' : '' }}>
                            {{ $dothoc->sodot }}
                        </option>
                        @endforeach -->
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
                    <a class="btn btn-primary" href="{{url('admin/phandot')}}"><i class="fa fa-undo"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('phandot.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>PHÂN ĐỢT HỌC</span></h5>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label for="khoahocs">Khóa học <span class="login-danger">*</span></label>
                                <select class="form-control select" name="khoahocs" id="khoahocs" aria-label=".form-select-sm example">
                                    <option value="">Chọn khóa học</option>
                                    @foreach($khoahocs as $key =>$khoahoc)
                                    <option value="{{$khoahoc->id}}">{{$khoahoc->makhoahoc}}</option>
                                    @endforeach
                                </select>
                                @error('khoahocs')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label for="dothocs">Chọn đợt học <span class="login-danger">*</span></label>
                                <select class="form-control select" name="dothocs" id="dothocs" aria-label=".form-select-sm example">
                                </select>
                                @error('dothocs')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <!-- <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Tổng sinh viên <span class="login-danger">*</span></label>          
                                <input type="text" name="tong_sv"  class="form-control"  readonly>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Tổng nam <span class="login-danger">*</span></label>
                                <input type="text" id="tongSinhVienNam" class="form-control" name="tong_nam">
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="form-group local-forms">
                                <label>Tổng nữ <span class="login-danger">*</span></label>
                                <input type="text" id="tongSinhVienNu" class="form-control" name="tong_nu">
                            </div>
                        </div> -->
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms calendar-icon">
                                <label>Thời gian bắt đầu <span class="login-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" value="{{old('tg_batdau')}}" name="tg_batdau" placeholder="DD-MM-YYYY">
                                @error('tg_batdau')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-group local-forms calendar-icon">
                                <label>Thời gian kết thúc <span class="login-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" value="{{old('tg_ketthuc')}}" name="tg_ketthuc" placeholder="DD-MM-YYYY">
                                @error('tg_ketthuc')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
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


                        <form id="myLop">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2" for="khoas"><strong>Chọn khoa quản lý </strong><span class="login-danger">*</span></label><br>

                                <div class="col-md-4">
                                    @foreach($khoas->take(6) as $key =>$khoa)
                                    <div class="checkbox">
                                        <label class="form-check-label" for="khoas_{{$khoa->id}}">
                                            <input class="form-check-input khoas" type="checkbox" name="khoas[]" value="{{$khoa->id}}"> - {{$khoa->tenkhoa}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    @foreach($khoas->slice(6) as $key =>$khoa)
                                    <div class="checkbox">
                                        <label class="form-check-label" for="khoas_{{$khoa->id}}">
                                            <input class="form-check-input khoas" type="checkbox" name="khoas[]" value="{{$khoa->id}}"> - {{$khoa->tenkhoa}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @error('khoas')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group row ">
                                <label class="col-form-label col-md-2" for=""><strong>Chọn lớp quản lý </strong><span class="login-danger">*</span></label><br>
                                <div class="col-md-21 " id="lops">
                                </div>
                                @error('lops')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </form>



                        <div class="form-group row">
                            <label class="col-form-label col-md-2" for=""><strong>Chọn giảng viên phụ trách </strong><span class="login-danger">*</span></label><br>

                            <div class="col-md-4">
                                @foreach($giangviens as $key =>$giangvien)
                                <div class="checkbox">
                                    <label class="form-check-label" for="giangviens_{{$giangvien->id}}">
                                        <input class="form-check-input " type="checkbox" name="giangviens[]" value="{{$giangvien->id}}"> - {{$giangvien->tengv}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @error('giangviens')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            <!-- <div class="col-md-4">
                                @foreach($giangviens->slice(6) as $key =>$giangvien)
                                <div class="checkbox">
                                    <label class="form-check-label" for="giangviens_{{$giangvien->id}}">
                                        <input class="form-check-input " type="checkbox" name="giangviens[]" value="{{$giangvien->id}}"> - {{$giangvien->tengv}}
                                    </label>
                                </div>
                                @endforeach
                            </div> -->

                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2"><strong>Ghi chú</strong></label>
                            <div class="col-md-10">
                                <textarea type="text" class="form-control" value="{{old('ghichu')}}" name="ghichu" id="" rows="5" cols="5" style="resize: none;" placeholder="Nhập văn bản ở đây"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-sm-2">
                            <div class="student-submit">
                                <button type="submit" name="phandothoc" class="btn btn-primary">Lưu</button>
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

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">DANH SÁCH PHÂN ĐỢT HỌC</h3>
                        </div>
                    </div>
                </div>
                <form action="{{ route('xoa-phan-dot-hoc') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="table-responsive ">
                        <button onclick="return confirm('Bạn có muốn xóa tất cả đợt học hay không?')" class="btn btn-outline-primary  me-2" type="submit">Xóa </button>
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="xoa_tat_ca_phan_dot" value="1">
                                        </div>
                                    </th>
                                    <th>STT</th>
                                    <th>Khóa học</th>
                                    <th>Đợt học</th>

                                    <th>Tổng sinh viên</th>
                                    <th>Tổng nam</th>
                                    <th>Tổng nữ</th>
                                    <th>Thời gian bắt đầu</th>
                                    <th>Thời gian kết thúc</th>
                                    <th>Thầy/Cô phụ trách</th>
                                    <th>Lớp</th>
                                    <th>Khoa</th>
                                    <th>Ghi chú</th>
                                    <th>Trạng thái</th>
                                    <th class="text-end">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($phandot as $keys => $phandots)
                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="phandot_ids[]" value="{{ $phandots->id }}">
                                        </div>
                                    </td>
                                    <td>{{$phandots->soThuTu1}}</td>
                                    <td>{{$phandots->khoahocs->makhoahoc}}</td>
                                    <td>{{$phandots->dothocs->sodot}}</td>

                                    <td>{{$phandots->tong_sv}}</td>
                                    <td>{{$phandots->tong_nam}}</td>
                                    <td>{{$phandots->tong_nu}}</td>
                                    <td>{{$phandots->tg_batdau}}</td>
                                    <td>{{$phandots->tg_ketthuc}}</td>
                                    <td width="10%">
                                        @if(count($phandots->giangvien))
                                        @foreach($phandots->giangvien as $giangviens)
                                        <a href="#" data-type="checklist" value="{{$giangviens->id}}" title="Select divisions" name="giangviens[]" class="giangviens" data-pk="{{$giangviens->id}}" role="button">
                                            <span class=" label-primary">{{$giangviens->tengv}}-{{$giangviens->sdt}}<br></span>
                                        </a>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td width="10%">
                                        @if(count($phandots->lop))
                                        @foreach($phandots->lop as $lops)
                                        <a href="#" data-type="checklist" value="{{$lops->id}}" title="Select divisions" name="lops[]" class="lops" data-pk="{{$lops->id}}" role="button">
                                            <span class=" label-primary">{{$lops->malop}},</span>
                                        </a>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td width="10%">
                                        @if(count($phandots->khoa))
                                        @foreach($phandots->khoa as $khoas)
                                        <a href="#" data-type="checklist" value="{{$khoas->id}}" title="Select divisions" name="khoas[]" class="khoas" data-pk="{{$khoas->id}}" role="button">
                                            <span class=" label-primary">{{$khoas->tenkhoa}},<br></span>
                                        </a>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>{{$phandots->ghichu}}</td>
                                    <td>
                                        @if($phandots->trangthai==0)
                                        <span class="text text-success">kích hoạt</span>
                                        @else
                                        <span class="text text-danger">không kích hoạt</span>
                                        @endif
                                    </td>
                </form>
                <td class="text-end">
                    <div class="actions">
                    <a href="{{url('admin/xem-dothoc/'.$phandots->id)}}" class="btn btn-sm bg-success-light me-2 ">
                            <i class="feather-eye"></i>
                        </a>
                        <a href="{{route('phandot.edit',[$phandots->id])}}" class="btn btn-sm bg-danger-light">
                            <i class="feather-edit"></i>
                        </a>

                        <form action="{{route('phandot.destroy',[$phandots->id])}}" method="POST" style="margin-top:-4px;">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Bạn có muốn xóa đợt học hay không?')" class="btn btn-sm">

                                <a class="btn btn-sm  bg-danger-light text-danger"><i class="far fa-trash-alt me-1"></i></a>
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
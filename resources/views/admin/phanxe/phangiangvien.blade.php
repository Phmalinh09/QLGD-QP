@extends('admin/layout')
@section('page_title','Phân Giảng viên')

@section('kehoach_select','active')
@section('phangiangvien_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Phân giảng viên</li>
            </ul>
        </div>
    </div>
</div>
<form action="" method="GET">
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-5 col-md-3">
                <div class="form-group local-forms">
                    <select class="form-control select" name="dot_hoc" type="search">
                        <option style="text-align: center;" value="">---- Tìm kiếm đợt học --------</option>
                        @foreach($phandots as $key =>$dothoc)
                        <option value="{{ $dothoc->dothocs->id }}" {{ request('dot_hoc') == $dothoc->dothocs->id ? 'selected' : '' }}>
                            {{ $dothoc->dothocs->sodot }} - {{ $dothoc->dothocs->khoahocs->makhoahoc }}
                        </option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="col-lg-5 col-md-3">
                <div class="form-group local-forms">
                    <select class="form-control select" name="giang_vien" type="search">
                        <option style="text-align: center;" value="">---- Tìm kiếm giảng viên --------</option>

                        @foreach($giangviens as $key =>$gv)
                        <option value="{{ $gv->id }}" {{ request('giang_vien') == $gv->id ? 'selected' : '' }}>
                            {{ $gv->tengv }} - {{ $gv->sdt }}
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
                    <a class="btn btn-primary" href="{{url('admin/phangiangvien')}}"><i class="fa fa-undo"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('phangiangvien.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>PHÂN GIẢNG VIÊN PHỤ TRÁCH</span></h5>
                        </div>
                        <div class="col-12 col-sm-4">
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

                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="dothocs">Chọn đợt học <span class="login-danger">*</span></label>
                                <select class="form-control select " name="dothocs" id="dothocs" aria-label=".form-select-sm example">
                                </select>
                                @error('dothocs')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="giangviens">Chọn chọn giáo viên <span class="login-danger">*</span></label>
                                <select class="form-control select" name="giangviens" id="giangviens" aria-label=".form-select-sm example">
                                </select>
                                @error('giangviens')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label class="col-form-label col-md-2" for=""><strong>Chọn số xe </strong><span class="login-danger">*</span></label><br>
                            <div class="col-md-21 " id="phanXe">
                            </div>
                            @error('so_xe')
                                <div class="d-block text-danger" style="margin-top: 5px; margin-bottom:-5px;">{{ $message }}</div>
                                @enderror
                        </div>
                        <!-- <div class="col-12 col-sm-4">
                            <div class="form-group local-forms">
                                <label for="soxeduynhat">Chọn xe <span class="login-danger">*</span></label>
                                <select class="form-control select" name="phanXe" id="phanXe" aria-label=".form-select-sm example">
                                </select>
                            </div>
                        </div> -->
                        <div class="col-12 col-sm-2">
                            <div class="student-submit">
                                <button type="submit" name="phangiangvien" class="btn btn-primary">Phân giảng viên</button>
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
                            <h3 class="page-title">DANH SÁCH PHÂN GIẢNG VIÊN</h3>
                        </div>
                    </div>
                </div>
                <form action="{{ route('xoa-phan-giang-vien') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="table-responsive ">
                        <button onclick="return confirm('Bạn có muốn xóa đợt phân giảng viên này không?')" class="btn btn-outline-primary  me-2" type="submit">Xóa </button>
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped " style=" white-space: normal;">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="xoa_tat_ca_phan_giang_vien" value="1">
                                        </div>
                                    </th>
                                    <th>STT</th>
                                    <th>Khóa học</th>
                                    <th>Đợt học</th>
                                    <th>Giáo viên</th>
                                    <th>Số xe</th>
                                    <th class="text-end">Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($phangiangvien as $keys => $phangiangviens)
                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" name="phangiangvien_ids[]" value="{{ $phangiangviens->id }}">
                                        </div>
                                    </td>
                                    <td>{{$phangiangviens->soThuTu1}}</td>
                                    <td>{{$phangiangviens->khoahocs->makhoahoc}}</td>
                                    <td>{{$phangiangviens->dothocs->sodot}}</td>
                                    <td>{{$phangiangviens->giangviens->tengv}} </td>                                   
                                    <td width="10%">
                                        @if(count($phangiangviens->phanxess))
                                        @foreach($phangiangviens->phanxess  as $so_xe)
                                        <a href="#" data-type="checklist" value="{{$so_xe->id}}" title="Select divisions" name="so_xe[]" class="so_xe" data-pk="{{$so_xe->id}}" role="button">
                                            <span class=" label-primary">Xe {{$so_xe->id}} ,</span>
                                        </a>
                                        @endforeach
                                        @endif
                                    </td>
                </form>
                <td class="text-end">
                    <div class="actions">
                        <form action="{{route('phangiangvien.destroy',[$phangiangviens->id])}}" method="POST" style="margin-top:-4px;">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Bạn có muốn xóa  hay không?')" class="btn btn-sm">

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
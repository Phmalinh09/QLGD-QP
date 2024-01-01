<?php

namespace App\Http\Controllers;

use App\Exports\ChitietdothocEmports;
use App\Exports\ChitietdothocSheet;
use App\Exports\EmptyRowExport;
use App\Exports\MauSinhvienExport;
use App\Exports\SinhvienEmports;
use App\Imports\SinhvienImports;
use App\Models\Giangvien;
use App\Models\Khoa;
use App\Models\Khoahoc;
use App\Models\LopModel;
use App\Models\Nganh;
use App\Models\Phandot;
use App\Models\Phangiangvien;
use App\Models\Phannhieuxe;
use App\Models\Sinhvien;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class SinhvienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mssv = $request->input('ms_sv');
        $ten = $request->input('ho_ten');
        $lop = $request->input('lop_hoc');
        $khoahoc = $request->input('khoa_hoc');
        $trangthai = $request->input('trang_thai');
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $lops = LopModel::orderBy('id', 'DESC')->get();
        $sinhviens = Sinhvien::with('khoahocs', 'lops')->orderBy('id', 'DESC')->search($mssv, $ten, $lop, $khoahoc, $trangthai)->get();
        $soThuTu1 = 1;
        foreach ($sinhviens as $sinhvien) {
            $sinhvien->soThuTu1 = $soThuTu1;
            $soThuTu1++;
        }

        return view('admin.sinhvien.sinhvien')->with(compact('lops', 'trangthai', 'khoahocs', 'sinhviens', 'mssv', 'ten', 'lop', 'khoahoc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $khoahocs = DB::table('khoahoc')->where(['trangthai' => 0])->get();
        $lops = LopModel::orderBy('id', 'DESC')->get();
        $lops = DB::table('lops')->where(['trangthai' => 0])->get();

        return view('admin.sinhvien.them')->with(compact('khoahocs', 'lops'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'mssv' => 'required|max:255',
                'hodem' => 'required|max:255',
                'ten' => 'required|max:255',
                'gioitinh' => 'required',
                'ngaysinh' => 'required',
                'khoahocs' => 'required',
                'lops' => 'required',
                'dienthoai' => 'required',
                'ghichu' => '',
                'trangthai' => 'required',
            ],
            [

                'mssv.required' => 'Mã lớp không được bỏ trống',
                'hodem.required' => 'Họ đệm không được bỏ trống',
                'ten.required' => 'Tên không được bỏ trống',
                'ngaysinh.required' => 'Ngày sinh không được bỏ trống',
                'khoahocs.required' => 'Khóa học không được bỏ trống',
                'lops.required' => 'Lớp không được bỏ trống',
                'dienthoai.required' => 'Số điện thoại không được bỏ trống',
            ]
        );
        $data = $request->all();
        $sinhvien = new Sinhvien();
        $sinhvien->mssv = $data['mssv'];
        $sinhvien->hodem = $data['hodem'];
        $sinhvien->ten = $data['ten'];
        $sinhvien->gioitinh = $data['gioitinh'];
        $sinhvien->ngaysinh = $data['ngaysinh'];
        $sinhvien->khoahoc_id = $data['khoahocs'];
        $sinhvien->lop_id = $data['lops'];
        $sinhvien->dienthoai = $data['dienthoai'];
        $sinhvien->trangthai = $data['trangthai'];
        $sinhvien->ghichu = $data['ghichu'];
        $sinhvien->save();
        $notification = array(
            'message' => 'Thêm sinh viên thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        // return redirect()->back()->with('status', 'Thêm sinh viên thành công'); //trả về trang mà bn đã gửi dữ liệu cho database

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sinhviens = Sinhvien::find($id);
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $lops = LopModel::orderBy('id', 'DESC')->get();
        return view('admin.sinhvien.sua')->with(compact('khoahocs', 'sinhviens', 'lops'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = $request->validate(
            [
                'mssv' => 'required|max:255',
                'hodem' => 'required|max:255',
                'ten' => 'required|max:255',
                'gioitinh' => 'required',
                'ngaysinh' => 'required|max:255',
                'khoahocs' => 'required',
                'lops' => 'required',
                'dienthoai' => 'required',
                'trangthai' => 'required',
                'ghichu' => '',
            ],
            [
                'mssv.required' => 'Mã lớp không được bỏ trống',
                'hodem.required' => 'Họ đệm không được bỏ trống',
                'ten.required' => 'Tên không được bỏ trống',
                'ngaysinh.required' => 'Số điện thoại không được bỏ trống',
                'khoahocs.required' => 'Khóa học không được bỏ trống',
                'lops.required' => 'Lớp không được bỏ trống',
                'dienthoai.required' => 'Số điện thoại không được bỏ trống',
            ]
        );
        //  $data = $request->all();
        $sinhvien = Sinhvien::find($id);
        $sinhvien->mssv = $data['mssv'];
        $sinhvien->hodem = $data['hodem'];
        $sinhvien->ten = $data['ten'];
        $sinhvien->gioitinh = $data['gioitinh'];
        $sinhvien->ngaysinh = $data['ngaysinh'];
        $sinhvien->khoahoc_id = $data['khoahocs'];
        $sinhvien->lop_id = $data['lops'];
        $sinhvien->dienthoai = $data['dienthoai'];
        $sinhvien->trangthai = $data['trangthai'];
        $sinhvien->ghichu = $data['ghichu'];
        $sinhvien->save();
        $notification = array(
            'message' => 'Cập nhật sinh viên thành công.',
            'alert-type' => 'success'
        );
        return redirect('admin/sinhvien')->with($notification); //trả về trang mà bn đã gửi dữ liệu cho database
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Sinhvien::find($id)->delete();
        $notification = array(
            'message' => 'Xóa sinh viên thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function export()
    {
        return Excel::download(new SinhvienEmports, 'sinhvien.xlsx');
    }
    public function import(Request $request)
    {
        try {
            $request->validate(
                [
                    'import_file' => "required",

                ],
                [
                    'import_file.required' => 'File tải lên thiếu dữ liệu hoặc',
                ]
            );
            Excel::import(new SinhvienImports(), $request->file('import_file'));
            $notification = array(
                'message' => 'Tải lên thành công.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
            // return back()->with('status', 'Tải lên thành công');
        } catch (\Exception $e) {
            // Lưu thông báo lỗi vào session
            Session::flash('error', 'Lỗi khi tải lên dữ liệu : ' . $e->getMessage() . ' ' . 'không xác định');
        }

        // Chuyển hướng về trang views
        return redirect()->back();
    }

    public function xoaSinhvien(Request $request)
    {
        if ($request->has('xoa_tat_ca')) {
            Sinhvien::truncate(); // Xóa tất cả dữ liệu trong bảng sinh viên
        } else {
            $ids = $request->input('sinhvien_ids');
            Sinhvien::whereIn('id', $ids)->delete(); // Xóa các sinh viên được chọn
        }

        // Redirect hoặc trả về thông báo thành công
        $notification = array(
            'message' => 'Xóa sinh viên thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        //return redirect()->back()->with('status', 'Xóa sinh viên thành công');
    }
    public function them_sinhvien(Request $request, $id)
    {
        $mssv = $request->input('ms_sv');
        $ten = $request->input('ho_ten');
        $lop = $request->input('lop_hoc');
        $trangthai = $request->input('trang_thai');
        $khoahoc = $request->input('khoa_hoc');
        $khoas = Khoa::orderBy('id', 'DESC')->get();
        $nganhs = Nganh::orderBy('id', 'DESC')->get();
        $lops = LopModel::with('khoas',  'nganhs')->where('id', $id)->where('trangthai', 0)->first();
        //$khoahocs = LopModel::with('khoahocs')->where('khoahoc_id',$id)->where('trangthai', 0)->first();
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $sinhviens = Sinhvien::with('lops', 'khoahocs')->orderBy('id', 'ASC')->where('lop_id', $lops->id)->orderBy('id', 'DESC')->search($mssv, $ten, $lop, $khoahoc, $trangthai)->get();
        return view('admin.lop.xemlop')->with(compact('trangthai', 'khoas', 'nganhs', 'lops', 'sinhviens', 'khoahocs', 'mssv', 'ten', 'lop', 'khoahoc'));
    }
    public function xem_dothoc(Request $request, $id)
    {
        // Lấy danh sách sinh viên chưa được phân phòng
        // $dotHoc = DotHoc::find($id);
        $mssv = $request->input('ms_sv');
        $ten = $request->input('ho_ten');
        $lop = $request->input('lop_hoc');
        $khoahoc = $request->input('khoa_hoc');
        $trangthai = $request->input('trang_thai');
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $lops = LopModel::orderBy('id', 'DESC')->get();

        $phanDots = Phandot::find($id);
        $lopIds = $phanDots->lop->pluck('id');
        $sinhViens = Sinhvien::whereIn('lop_id', $lopIds)->orderBy('id', 'DESC')->search($mssv, $ten, $lop, $khoahoc, $trangthai)->get();
        $soThuTu1 = 1;
        foreach ($sinhViens as $sinhvien) {
            $sinhvien->soThuTu1 = $soThuTu1;
            $soThuTu1++;
            $soXeDaPhan = $sinhvien->phanxe ? $sinhvien->phanxe->so_xe : null;
            $sinhvien->soXeDaPhan = $soXeDaPhan;
            $soPhongDaPhan = $sinhvien->phanphong ? $sinhvien->phanphong->tenphong : null;
            $sinhvien->soPhongDaPhan = $soPhongDaPhan;
        }
        return view('admin.phandot.xemdothoc')->with(compact('trangthai', 'sinhViens', 'mssv', 'ten', 'lop', 'khoahoc', 'lops', 'khoahocs', 'phanDots'));
    }
    public function cvxem_dothoc(Request $request, $id)
    {
        // Lấy danh sách sinh viên chưa được phân phòng
        // $dotHoc = DotHoc::find($id);
        $mssv = $request->input('ms_sv');
        $ten = $request->input('ho_ten');
        $lop = $request->input('lop_hoc');
        $khoahoc = $request->input('khoa_hoc');
        $trangthai = $request->input('trang_thai');
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $lops = LopModel::orderBy('id', 'DESC')->get();

        $phanDots = Phandot::find($id);
        $lopIds = $phanDots->lop->pluck('id');
        $sinhViens = Sinhvien::whereIn('lop_id', $lopIds)->orderBy('id', 'DESC')->search($mssv, $ten, $lop, $khoahoc, $trangthai)->get();
        $soThuTu1 = 1;
        foreach ($sinhViens as $sinhvien) {
            $sinhvien->soThuTu1 = $soThuTu1;
            $soThuTu1++;
            $soXeDaPhan = $sinhvien->phanxe ? $sinhvien->phanxe->so_xe : null;
            $sinhvien->soXeDaPhan = $soXeDaPhan;
            $soPhongDaPhan = $sinhvien->phanphong ? $sinhvien->phanphong->tenphong : null;
            $sinhvien->soPhongDaPhan = $soPhongDaPhan;
        }
        return view('chuyenvien.xemdothoc')->with(compact('trangthai', 'sinhViens', 'mssv', 'ten', 'lop', 'khoahoc', 'lops', 'khoahocs', 'phanDots'));
    }
    public function trangthais(Request $request)
    {
        $data = $request->all();
        $sinhvien = Sinhvien::find($data['sinhvien_id']);
        $sinhvien->trangthai = $data['trangthai'];
        $sinhvien->save();
    }

    public function export_chitiet($id)
    {
        $phanDots = Phandot::find($id);
        $lopIds = $phanDots->lop->pluck('id');
        $sinhViens = Sinhvien::whereIn('lop_id', $lopIds)->orderBy('id', 'DESC')->select('id', 'mssv', 'hodem', 'ten', 'gioitinh', 'ngaysinh', 'dienthoai', 'lop_id', 'khoahoc_id', 'trangthai', 'ghichu')->get();
        $soThuTu1 = 1;
        $dotHoc = $phanDots->dothocs->sodot;
        $giangVienIds = $phanDots->giangvien->pluck('id')->toArray(); //danh sách giảng viên ở trong phân đợt
        $phangiangvien = Phangiangvien::whereIn('giangvien_id', $giangVienIds)->get(); //danh sách giảng viên ở bảng phân giảng viên
        //  dd($phangiangvien);
        //$soxes = $phangiangvien->pluck('so_xe')->toArray(); //danh sach so xe của bảng phân giảng viên
        //dd($soxes);
        $phangiangvienIds = $phangiangvien->pluck('id')->toArray();
        $giangviens = Phannhieuxe::whereIn('phangiangvien_id', $phangiangvienIds)->orderBy('so_xe_id')->get();
        //dd($giangviens);

        foreach ($sinhViens as $key => $sinhvien) {
            $khoahoc = Khoahoc::select('makhoahoc')->where('id', $sinhvien->khoahoc_id)->first();
            $sinhViens[$key]->khoahoc_id = $khoahoc->makhoahoc;
            $lop = LopModel::select('malop')->where('id', $sinhvien->lop_id)->first();
            $sinhViens[$key]->lop_id = $lop->malop;
            $so_xe = $sinhvien->phanxe ? $sinhvien->phanxe->so_xe : null;
            $sinhvien->so_xe = $so_xe;
            $so_phong = $sinhvien->phanphong ? $sinhvien->phanphong->tenphong : null;
            $sinhvien->so_phong = $so_phong;
            $sinhvien->soThuTu1 = $soThuTu1;
            $soThuTu1++;
        }
        foreach ($giangviens as $gv) {
            $so_xe1 = $gv->so_xe_id;
            $filteredSinhViens = $sinhViens->where('so_xe', $so_xe1);
            // $giangvien = Giangvien::whereIn('id', $gv->phanGiangvien->pluck('giangvien_id')->toArray())->get(); 
            $giangvien = Giangvien::where('id', $gv->phanGiangvien->giangvien_id)->get();
            //  dd($giangvien);   
            $tengiangvien_sdt_pairs = $giangvien->map(function ($item) {
                return $item->tengv . '-' . $item->sdt;
            });
            //  dd($tengiangvien_sdt_pairs); 
            $export = new ChitietdothocEmports($filteredSinhViens, $dotHoc, $tengiangvien_sdt_pairs);
            $exports[] = $export;
        }
        if (empty($exports)) {
            $exports = [new ChitietdothocEmports($sinhViens, $dotHoc, ['']),];
        }

        return Excel::download(new ChitietdothocSheet($exports), 'chitietdothoc.xlsx');
    }
    public function MauSinhvienExport(){
        return Excel::download(new MauSinhvienExport, 'File_Mau_Sinhvien.xlsx');
    }
}
 // if (empty($exports)) {
            
        //     $notification = array(
        //         'message' => 'Lỗi: Chưa đầy đủ thông tin.',
        //         'alert-type' => 'error'
        //     );
        //    // $errorMessage = "Lỗi: Chưa đầy đủ thông tin.";
        //     return redirect()->back()->with($notification);
        //     //return view('error-page', compact('errorMessage'));
        // }//return redirect()->back()->with($notification);
<?php

namespace App\Http\Controllers;

use App\Exports\ChitietdothocSheet;
use App\Exports\PhanxeExport;
use App\Models\Dothoc;
use App\Models\Giangvien;
use App\Models\Khoa;
use App\Models\Khoahoc;
use App\Models\LopModel;
use App\Models\Nhieugiangvien;
use App\Models\Nhieulop;
use App\Models\Phandot;
use App\Models\Phangiangvien;
use App\Models\Phannhieuxe;
use App\Models\Phanxe;
use App\Models\Sinhvien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PhanxeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $soxe = $request->input('so_xe');
        $dothoc = $request->input('dot_hoc');
        $mssv = $request->input('ms_sv');
        $ten = $request->input('ho_ten');
        $lop = $request->input('lop_hoc');
        $phandots = Phandot::get();
        //$giangviens = Giangvien::orderBy('id', 'DESC')->get();
        $lops = LopModel::get();
        $khoas = Khoa::get();
        //  $khoas = Khoa::pluck('tenkhoa', 'id');
        $khoahocs = Khoahoc::get();
        $dothocs = Dothoc::get();
        $phanxe = Phanxe::with('dothocs', 'khoahocs')->search($soxe, $dothoc, $ten, $lop, $mssv)->get();
        $soThuTu1 = 1;
        foreach ($phanxe as $phanxes) {
            $phanxes->soThuTu1 = $soThuTu1;
            $soThuTu1++;
        }

        return view('admin.phanxe.phanxe')->with(compact('dothoc', 'soxe', 'dothocs', 'khoahocs', 'khoas', 'lops', 'phandots', 'phanxe'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        $phandots = Phandot::orderBy('id', 'DESC')->get();
        $phandots = DB::table('phandot')->where(['trangthai' => 0])->get();
        $khoas = Khoa::orderBy('id', 'DESC')->get();
        $khoas = DB::table('khoas')->where(['trangthai' => 0])->get();
        $lops = LopModel::orderBy('id', 'DESC')->get();
        $lops = DB::table('lops')->where(['trangthai' => 0])->get();
        $dothocs = Dothoc::orderBy('id', 'DESC')->get();
        $dothocs = DB::table('dothoc')->where(['trangthai' => 0])->get();
        //$giangviens = Giangvien::orderBy('id', 'DESC')->get();
      //  $giangviens = DB::table('giangiven')->where(['trangthai' => 0])->get();
        $sinhviens = Sinhvien::orderBy('id', 'DESC')->get();
        $sinhviens = DB::table('sinhvien')->where(['trangthai' => 0])->get();
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $khoahocs = DB::table('khoahoc')->where(['trangthai' => 0])->get();
        return view('admin.phanxe.them')->with(compact('khoahocs', 'khoas', 'lops', 'dothocs', 'giangviens', 'sinhviens', 'phandots'));
    }









    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'khoahocs' => 'required',
                'dothocs' => 'required',
            ],
            [
                'khoahocs.required' => 'Khóa học không được bỏ trống',
                'dothocs.required' => 'Đợt học không được bỏ trống',
            ]
        );

        $dotHocId = $request->input('dothocs'); // Lấy giá trị đợt học từ form             
        // Lấy thông tin đợt học và phân đợt        
        $dotHoc = DotHoc::find($dotHocId);

        // Kiểm tra xem biến $dotHoc có tồn tại và có giá trị không
        if (!$dotHoc) {
            $notification = array(
                'message' => 'Không tìm thấy thông tin về đợt học.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
        // Kiểm tra xem đợt học đã được phân xe chưa
        if ($dotHoc->phanXe->count() > 0) {
            $notification = array(
                'message' => 'Đợt học này đã được phân xe.Xóa đợt học này để phân lại xe.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
        $phanDots = $dotHoc->phanDot;
        // Kiểm tra xem biến $phanDots có tồn tại và có giá trị không
        if (!$phanDots) {
            $notification = array(
                'message' => 'Đợt học này chưa được phân lớp.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }

        // Kiểm tra xem biến $phanDots có thuộc tính 'tong_sv' không
        if (!isset($phanDots->tong_sv)) {
            $notification = array(
                'message' => 'Không tìm thấy thông tin số sinh viên trong đợt học.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
        $soXe  = ceil(($phanDots->tong_sv + $phanDots->giangvien->count()) / 45);
        //dd($soXe);

        // Lấy danh sách lớp thuộc đợt học từ bảng "phan_dot" thông qua bảng "nhieu_lop"
        $lopIds = $phanDots->lop->pluck('id');
        //dd($lopIds);
        // Lấy danh sách sinh viên thuộc các lớp
        $sinhVien = SinhVien::whereIn('lop_id', $lopIds)->where('trangthai', 'Hoạt động')->orderBy('id', 'DESC')->get();
        // dd($sinhVien);
        // Lấy danh sách giảng viên thuộc đợt học từ bảng "phan_dot" thông qua bảng "nhieu_giang_vien"
        //$giangVienIds = $phanDots->giangvien->pluck('id');
       // $giangVien = GiangVien::whereIn('id', $giangVienIds)->get();
        // dd($giangVienIds);
        
        // Sắp xếp sinh viên vào từng xe theo lớp
        // Phân chia sinh viên vào từng xe
        // Khởi tạo mảng xe
        $xe = [];
        $soXe = 0;
        //$soXe = 1;
        //$soGiangVien = 0; // Biến đếm số giảng viên đã gán cho từng sinh viên
        foreach ($sinhVien as $sinhViens) {
            // Lấy giảng viên cho sinh viên hiện tại
           // $giangVienHienTai = $giangVien[$soGiangVien % $giangVien->count()];
            // Kiểm tra nếu số lượng sinh viên đã được phân vào xe hiện tại vượt quá 45
            if (!isset($xe[$soXe]) || count($xe[$soXe]) >= 44) {
                $soXe++;
            }
            // Tạo xe mới nếu xe chưa tồn tại trong mảng xe
            if (!isset($xe[$soXe])) {
                $xe[$soXe] = [];
                // $soGiangVien++;   //Tăng số giảng viên đã gán cho từng xe
                // $giangVien->sortBy('so_xe'); //Sắp xếp giảng viên theo chiều tăng của xe
            }
            // Lưu thông tin phân xe vào bảng "phân xe"
            $phanXe = new PhanXe;
            $phanXe->dothoc_id = $dotHocId;
            $phanXe->khoahoc_id = $dotHoc['khoahoc_id'];
            $phanXe->lop_id = $sinhViens->lops->malop;
            $phanXe->sinhvien_id = $sinhViens->id;
            $phanXe->mssv = $sinhViens->mssv;
            $phanXe->hosv = $sinhViens->hodem;
            $phanXe->tensv = $sinhViens->ten;
            $phanXe->gioitinh = $sinhViens->gioitinh;
            $phanXe->ngaysinh = $sinhViens->ngaysinh;
           // $phanXe->giangvien_id = $giangVienHienTai->tengv . '-' . $giangVienHienTai->sdt;
            $phanXe->so_xe = $soXe;
            $phanXe->save();

            // Lưu thông tin phân xe vào mảng xe hiện tại
            $xe[$soXe][] = $phanXe;
            // Nếu đã gán đủ giảng viên cho một xe, tăng số xe và đặt lại số giảng viên đã gán
            // if (count($xe[$soXe]) % 44 == 0) {
            //     if ($soGiangVien % 1 == 0) {
            //         $soGiangVien++;   //Tăng số giảng viên đã gán cho từng xe
            //         // $soXe++;
            //         $giangVien->sortBy('so_xe'); //Sắp xếp giảng viên theo chiều tăng của xe
            //     }
            // }
        }
        $notification = array(
            'message' => 'Phân xe thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        //return response()->json(['message' => 'Phân xe thành công']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $phanxes = Phanxe::find($id);
        Phanxe::find($id)->delete();
        $notification = array(
            'message' => 'Xóa danh sách phân xe này thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function xoaPhanxe(Request $request)
    {
        if ($request->has('xoa_tat_ca_phan_xe')) {
            Phanxe::truncate(); // Xóa tất cả dữ liệu trong bảng lớp
        } else {
            $ids = $request->input('phanxe_ids');
            Phanxe::whereIn('id', $ids)->delete(); // Xóa các lớp được chọn
        }

        // Redirect hoặc trả về thông báo thành công
        $notification = array(
            'message' => 'Xóa danh sách phân xe này thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



    public function export_phanxe(Request $request){
        $dothocID = $request->input('dot_hocs');
      //  dd($dothocID);
        $dotHoc = DotHoc::find($dothocID);
        //dd($dotHoc);
        // Kiểm tra xem biến $dotHoc có tồn tại và có giá trị không
        if (!$dotHoc) {
            $notification = array(
                'message' => 'Không tìm thấy thông tin về đợt học.',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }
        $phanDots = $dotHoc->phanDot;
       // dd($phanDots);
       // Kiểm tra xem biến $phanDots có tồn tại và có giá trị không
       if (!$phanDots) {
        $notification = array(
            'message' => 'Đợt học này chưa được phân lớp.',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
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
            $export = new PhanxeExport($filteredSinhViens, $dotHoc, $tengiangvien_sdt_pairs);
            $exports[] = $export;
        }
        if (empty($exports)) {
            $exports = [new PhanxeExport($sinhViens, $dotHoc, ['']),];
        }

        return Excel::download(new ChitietdothocSheet($exports), 'chitietphanxe.xlsx');
    }
}

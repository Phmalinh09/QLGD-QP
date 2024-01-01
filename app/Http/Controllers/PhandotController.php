<?php

namespace App\Http\Controllers;

use App\Models\Dothoc;
use App\Models\Giangvien;
use App\Models\Khoa;
use App\Models\Khoahoc;
use App\Models\LopModel;
use App\Models\Nhieugiangvien;
use App\Models\Nhieukhoa;
use App\Models\Nhieulop;
use App\Models\Phandot;
use App\Models\Sinhvien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhandotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dothoc = $request->input('dothocstk');
        $khoahoc = $request->input('khoahocstk');

        $phandot = Phandot::orderBy('id', 'DESC')->search($dothoc, $khoahoc)->get();
        $giangviens = Giangvien::orderBy('id', 'DESC')->where(['trangthai' => 0])->get();
        $lops = LopModel::orderBy('id', 'DESC')->get();
        $khoas = Khoa::orderBy('id', 'DESC')->get();
        //  $khoas = Khoa::pluck('tenkhoa', 'id');
        $khoahocs = Khoahoc::get();
        $dothocs = Dothoc::get();
        $lops = collect($lops); // Chuyển đổi kết quả truy vấn thành Laravel Collection
        $columns = $lops->chunk(15); // Chia nhỏ danh sách thành các phân đoạn có 6 item

        $soThuTu1 = 1;
        foreach ($phandot as $phandots) {
            $phandots->soThuTu1 = $soThuTu1;
            $soThuTu1++;
        }
        return view('admin.phandot.phandot')->with(compact('dothoc', 'khoahoc', 'giangviens', 'dothocs', 'khoahocs', 'khoas', 'lops', 'phandot', 'columns'));
    }



    public function getLopkhoa(Request $request)
    {
        $khoaIds = [];
        $khoaIds = $request->input('khoa_ids');
        if (empty($khoaIds)) {
            // Xóa danh sách lớp nếu không có khoa quản lý nào được chọn
            return response()->json([]);
        }
        $lops = Khoa::with('lops')->whereIn('id', $khoaIds)->get();
        return response()->json($lops);
    }
    public function getDothoc(Request $request)
    {
        $khoahocs = $request->input('khoahoc_id');
        $dothocs = Dothoc::where('khoahoc_id', $khoahocs)->get();
        return response()->json($dothocs);
    }
    public function getDothoctk(Request $request)
    {
        $khoahocs = $request->input('khoahoc_idtk');
        $dothocs = Dothoc::where('khoahoc_id', $khoahocs)->get();
        return response()->json($dothocs);
    }
    public function getTongSinhVien(Request $request)
    {
        $lopIds = $request->input('lops');
        $semesterInfo = DB::table('phandot')
            ->whereIn('lop_id', $lopIds)
            ->select(
                DB::raw('SUM(tong_sv) as tong_sv'),
                DB::raw('SUM(tong_nam) as tong_nam'),
                DB::raw('SUM(tong_nu) as tong_nu')
            )
            ->first();
        return response()->json($semesterInfo);
    }


    // public function layKetQua(Request $request)
    // {
    //     $lops = [];
    //     $lops = $request->input('lops');

    //     // $tongSinhVien = 0;
    //     // $tongSinhVienNam = 0;
    //     // $tongSinhVienNu = 0;
    //     // foreach ($lops as $lop) {
    //     //     $lopData = LopModel::where('id', $lop)->first();
    //     //     if ($lopData) {
    //     //         $tongSinhVien += $lopData->tong;
    //     //         $tongSinhVienNam += $lopData->tongnam;
    //     //         $tongSinhVienNu += $lopData->tongnu;
    //     //     }
    //     // }
    //     // $tongSinhVien = SinhVien::whereIn('lop_id', $lops)->count();
    //     // $tongSinhVienNam = SinhVien::whereIn('lop_id', $lops)->where('gioitinh', 'Nam')->count();
    //     // $tongSinhVienNu = SinhVien::whereIn('lop_id', $lops)->where('gioitinh', 'Nữ')->count();
    //     $tongSinhVien = LopModel::whereIn('id', $lops)->sum('tong');
    //     $tongSinhVienNam = LopModel::whereIn('id', $lops)->sum('tongnam');
    //     $tongSinhVienNu = LopModel::whereIn('id', $lops)->sum('tongnu');

    //     $ketQua = [
    //         'tongSinhVien' => $tongSinhVien,
    //         'tongSinhVienNam' => $tongSinhVienNam,
    //         'tongSinhVienNu' => $tongSinhVienNu,
    //     ];
    //     //dd($ketQua);

    //     return response()->json($ketQua);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $khoas = Khoa::orderBy('id', 'DESC')->where(['trangthai' => 0])->get();
        //  $khoas = DB::table('khoas')->where(['trangthai' => 0])->get();
        $lops = LopModel::orderBy('id', 'DESC')->where(['trangthai' => 0])->get();
        //  $lops = DB::table('lops')->where(['trangthai' => 0])->get();
        $dothocs = Dothoc::orderBy('id', 'DESC')->where(['trangthai' => 0])->get();
        //  $dothocs = DB::table('dothoc')->where(['trangthai' => 0])->get();
        $giangviens = Giangvien::orderBy('id', 'DESC')->where(['trangthai' => 0])->get();
        // $giangviens = DB::table('giangiven')->where(['trangthai' => 0])->get();

        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $khoahocs = DB::table('khoahoc')->where(['trangthai' => 0])->get();
        return view('admin.phandot.them')->with(compact('khoahocs', 'khoas', 'lops', 'dothocs', 'giangviens'));
    }


    // public function getKhoas(Request $request)
    // {
    //     $khoas = [];
    //     if ($search = $request->name) {
    //         $khoas = Khoa::where('tenkhoa', 'LIKE', "%$search%")->get();
    //     }
    //     return response()->json($khoas);
    // }



    public function store(Request $request)
    {
        $validator = $request->validate(
            [
                'khoahocs' => 'required',
                'dothocs' => 'required',
                //'tong_sv' => 'required',
                //'tong_nam' => 'required',
                //'tong_nu' => 'required',
                'tg_batdau' => 'required',
                'tg_ketthuc' => 'required',
                'giangviens' => 'required',
                'ghichu' => '',
                'lops' => 'required',
                'khoas' => 'required',
                'trangthai' => 'required'
            ],
            [
                'dothocs.required' => 'Đợt học không được bỏ trống',
                'khoahocs.required' => 'Khóa học không được bỏ trống',
                'giangviens.required' => 'Giảng viên không được bỏ trống',
                'tg_batdau.required' => 'Thời gian bắt đầu không được bỏ trống',
                'tg_ketthuc.required' => 'Thời gian kết thúc không được bỏ trống',
                'lops.required' => 'Lớp quản lý không được bỏ trống',
                'khoas.required' => 'Khoa quản lý không được bỏ trống',
            ]

        );

        // Lấy danh sách mã lớp được chọn từ request
        $selectedClasses = $request->input('lops', []);

        // Tính toán tổng sinh viên, tổng sinh viên nam và tổng sinh viên nữ của các lớp được chọn
        $tongSinhVien = SinhVien::whereIn('lop_id', $selectedClasses)->count();
        $tongSinhVienNam = SinhVien::whereIn('lop_id', $selectedClasses)->where('gioitinh', 'Nam')->count();
        $tongSinhVienNu = SinhVien::whereIn('lop_id', $selectedClasses)->where('gioitinh', 'Nữ')->count();

        $data['dothocs'] = $request->input('dothocs');
        $data = $request->all();
        $existingPhandot = Phandot::where('khoahoc_id', $data['khoahocs'])
            ->where('dothoc_id', $data['dothocs'])
            ->first();

        if ($existingPhandot) {
            $notification = array(
                'message' => 'Đợt học này đã được phân đợt.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        
        $phandot = new Phandot();
        $phandot->khoahoc_id = $data['khoahocs'];
        $phandot->dothoc_id = $data['dothocs'];
        // $phandot->dothoc_id = $data['dothocs'];
        $phandot->tong_sv = $tongSinhVien;
        $phandot->tong_nam = $tongSinhVienNam;
        $phandot->tong_nu = $tongSinhVienNu;
        $phandot->tg_batdau = $data['tg_batdau'];
        $phandot->tg_ketthuc = $data['tg_ketthuc'];
        $phandot->ghichu = $data['ghichu'];
        $phandot->trangthai = $data['trangthai'];
        foreach ($data['khoas'] as $khoa) {
            $phandot->khoa_id = $khoa[0];
        }
        foreach ($data['lops'] as $key => $lop) {
            $phandot->lop_id = $lop[0];
        }
        foreach ($data['giangviens'] as  $giangvien) {
            $phandot->giangvien_id = $giangvien[0];
        }
        $phandot->save();
        $phandot->conhieukhoa()->attach($data['khoas']);
        $phandot->conhieulop()->attach($data['lops']);
        $phandot->conhieugiangvien()->attach($data['giangviens']);



        $notification = array(
            'message' => 'Phân đợt học thành công',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); //trả về trang mà bn đã gửi dữ liệu cho database

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
        $nhieukhoa = [];
        $nhieulop = [];
        $nhieugiangvien = [];
        $phandots = Phandot::find($id);
        $nhieukhoa = $phandots->khoa->pluck('id')->toArray();
        $nhieulop = $phandots->lop->pluck('id')->toArray();
        $nhieugiangvien = $phandots->giangvien->pluck('id')->toArray();
        $giangviens = Giangvien::orderBy('id', 'DESC')->where(['trangthai' => 0])->get();
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->where(['trangthai' => 0])->get();
        $dothocs = Dothoc::orderBy('id', 'DESC')->where(['trangthai' => 0])->get();
        $khoas = Khoa::orderBy('id', 'DESC')->where(['trangthai' => 0])->get();
        $lops = LopModel::orderBy('id', 'DESC')->where(['trangthai' => 0])->get();
        $lops = collect($lops); // Chuyển đổi kết quả truy vấn thành Laravel Collection
        $columns = $lops->chunk(25); // Chia nhỏ danh sách thành các phân đoạn có 6 item
        return view('admin.phandot.sua')->with(compact('nhieugiangvien', 'giangviens', 'khoahocs', 'lops', 'khoas', 'dothocs', 'phandots', 'nhieulop', 'nhieukhoa', 'columns'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'khoahocs' => 'required',
                'dothocs' => 'required',
                // 'tong_sv' => 'required',
                //'tong_nam' => 'required',
                // 'tong_nu' => 'required',
                'tg_batdau' => 'required',
                'tg_ketthuc' => 'required',
                'ghichu' => '',
                'giangviens' => 'required',
                'lops' => 'required',
                'khoas' => 'required',
                'trangthai' => 'required',
            ],
            [
                //'sodot.unique' => 'Đợt học không được bỏ trống',
            ]
        );
        //   $data = $request->all();

        $selectedClasses = $request->input('lops', []);

        // Tính toán tổng sinh viên, tổng sinh viên nam và tổng sinh viên nữ của các lớp được chọn
        $tongSinhVien = SinhVien::whereIn('lop_id', $selectedClasses)->count();
        $tongSinhVienNam = SinhVien::whereIn('lop_id', $selectedClasses)->where('gioitinh', 'Nam')->count();
        $tongSinhVienNu = SinhVien::whereIn('lop_id', $selectedClasses)->where('gioitinh', 'Nữ')->count();
        $phandot = Phandot::find($id);
        $phandot->khoahoc_id = $data['khoahocs'];
        $phandot->dothoc_id = $data['dothocs'];
        $phandot->tong_sv = $tongSinhVien;
        $phandot->tong_nam = $tongSinhVienNam;
        $phandot->tong_nu = $tongSinhVienNu;
        $phandot->tg_batdau = $data['tg_batdau'];
        $phandot->tg_ketthuc = $data['tg_ketthuc'];
        $phandot->ghichu = $data['ghichu'];
        $phandot->trangthai = $data['trangthai'];
        $phandot->khoa()->sync($request->input('khoas', []));
        $phandot->lop()->sync($request->input('lops', []));
        $phandot->giangvien()->sync($request->input('giangviens', []));
        $phandot->save();
        $notification = array(
            'message' => 'Cập nhật phân đợt học thành công',
            'alert-type' => 'success'
        );
        return redirect('admin/phandot')->with($notification); //trả về trang mà bn đã gửi dữ liệu cho database
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phandots = Phandot::find($id);
        Nhieulop::whereIn('phandot_id', [$phandots->id])->delete();
        Nhieukhoa::whereIn('phandot_id', [$phandots->id])->delete();
        Nhieugiangvien::whereIn('phandot_id', [$phandots->id])->delete();
        Phandot::find($id)->delete();
        $notification = array(
            'message' => 'Xóa đợt học thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function xoaPhandothoc(Request $request)
    {
        if ($request->has('xoa_tat_ca_phan_dot')) {
            //   DB::table('nhieukhoa')->truncate();
            //    DB::table('nhieulop')->truncate();
            // Vô hiệu hóa ràng buộc khóa ngoại
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Nhieulop::truncate();
            Nhieukhoa::truncate();
            Nhieugiangvien::truncate();
            Phandot::truncate(); // Xóa tất cả dữ liệu trong bảng lớp
            // Bật lại ràng buộc khóa ngoại
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } else if ($id = $request->input('id')) {
            Phandot::whereIn('id', $id)->delete();
        } else {
            $ids = $request->input('phandot_ids');
            Phandot::whereIn('id', $ids)->delete(); // Xóa các lớp được chọn
        }

        // Redirect hoặc trả về thông báo thành công
        $notification = array(
            'message' => 'Xóa đợt học thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

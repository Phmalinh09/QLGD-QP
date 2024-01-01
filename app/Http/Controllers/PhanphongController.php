<?php

namespace App\Http\Controllers;

use App\Models\Dothoc;
use App\Models\Khoa;
use App\Models\Khoahoc;
use App\Models\LopModel;
use App\Models\Phandot;
use App\Models\Phanphong;
use App\Models\Phong;
use App\Models\Sinhvien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhanphongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sophong = $request->input('so_phong');
        $dothoc = $request->input('dot_hoc');
        $mssvs = $request->input('ms_sv');
        $ten = $request->input('ho_ten');

        $phongs = Phong::orderBy('id', 'DESC')->get();
        $phandot = Phandot::orderBy('id', 'DESC')->get();
        $lops = LopModel::orderBy('id', 'DESC')->get();
        $khoas = Khoa::orderBy('id', 'DESC')->get();
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $dothocs = Dothoc::orderBy('id', 'DESC')->get();
        $phanphongs = Phanphong::with('dothocs', 'khoahocs')->search($sophong, $dothoc, $mssvs, $ten)->get();
        $soThuTu1 = 1;
        foreach ($phanphongs as $phanphong) {
            $phanphong->soThuTu1 = $soThuTu1;
            $soThuTu1++;
        }
        return view('admin.phanphong.phanphong')->with(compact('sophong', 'dothoc', 'mssvs', 'ten', 'phongs', 'dothocs', 'khoahocs', 'khoas', 'lops', 'phandot', 'phanphongs'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function getGioitinh(Request $request)
    {
        $phong_id = $request->input('phong_id');
        $phongs = Phong::where('gioitinh', $phong_id)->get();
        return response()->json($phongs);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'dothocs' => 'required',
                'phongs' => 'required',
                'gioitinh' => 'required',

            ],
            [
                'dothocs.required' => 'Đợt học không được bỏ trống',
                'phongs.required' => 'Phòng không được bỏ trống',
                'gioitinh.required' => 'Phòng không được bỏ trống',
            ]
        );
        // $khoahoc = $request->input('khoahocs');
        $dotHocId = $request->input('dothocs');
        $gioiTinh = $request->input('gioitinh');
        $phongIds = $request->input('phongs');
        // Lấy danh sách sinh viên chưa được phân phòng
        $dotHoc = DotHoc::find($dotHocId);
        $phanDots = $dotHoc->phanDot;

        if (!$phanDots) {
            $notification = array(
                'message' => 'Không tìm thấy thông tin phân đợt cho đợt học này.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


        $lopIds = $phanDots->lop->pluck('id');
        $sinhViens = Sinhvien::whereIn('lop_id', $lopIds)
            ->where('gioitinh', $gioiTinh)->where('trangthai', 'Hoạt động')->orderBy('id', 'DESC')
            ->get();
        //    dd($sinhViens);
        // Lấy thông tin phòng
        $phong = Phong::where('id', $phongIds)->first();
        //dd($phong);
        $soCho = $phong->socho;
        //$svDaPhanPhong = PhanPhong::pluck('sinhvien_id'); // Lấy danh sách sinh viên đã được phân phòng
        $svDaPhanPhong = PhanPhong::pluck('sinhvien_id')->toArray(); // Lấy danh sách sinh viên đã được phân phòng
        $svChuaPhanPhong = collect();
        $phongHienTai = $phong;
        $daSuDung = collect();
        foreach ($sinhViens as $sinhVien) {
            if ($sinhVien->gioitinh == $gioiTinh) {
                foreach ($phongIds as $phongId) {
                    $phongHienTai = Phong::where('id', $phongId)->first();
                    $soCho = $phongHienTai->socho;

                    if (!in_array($sinhVien->id, $svDaPhanPhong)) {
                        // Kiểm tra nếu phòng đã đủ chỗ hoặc không phù hợp với giới tính
                        // thì chuyển sang phòng tiếp theo
                        if (count($svDaPhanPhong) >= $soCho && $phongHienTai->gioitinh != $gioiTinh) {
                            // Lưu phòng hiện tại vào danh sách phòng đã sử dụng
                            $daSuDung->push($phongHienTai->tenphong);
                            // Tìm phòng tiếp theo phù hợp với giới tính, không nằm trong danh sách phòng đã sử dụng
                            $phongHienTai = Phong::where('gioitinh', $gioiTinh)
                                ->whereNotIn('tenphong', $daSuDung->toArray())
                                ->first();
                            // Nếu không tìm thấy phòng phù hợp, thoát khỏi vòng lặp
                            if (!$phongHienTai) {
                                break;
                            }
                            // $soCho = $phongHienTai->socho;
                        }
                        // Xếp sinh viên vào phòng
                        
                        if ($soCho > 0) {
                            // $svDaPhanPhong->push($sinhVien->mssv); // Thêm sinh viên vào danh sách sinh viên đã được phân phòng
                            array_push($svDaPhanPhong, $sinhVien->id);
                            // Lưu thông tin phân phòng vào bảng "phan_phong"
                            $phanPhong = new PhanPhong();
                            $phanPhong->khoahoc_id = $dotHoc['khoahoc_id'];
                            $phanPhong->dothoc_id = $dotHocId;
                            $phanPhong->phong_id = $phongHienTai->id;
                            $phanPhong->tenphong = $phongHienTai->tenphong;
                            $phanPhong->sinhvien_id = $sinhVien->id;
                            $phanPhong->mssv = $sinhVien->mssv;
                            $phanPhong->hosv = $sinhVien->hodem;
                            $phanPhong->tensv = $sinhVien->ten;
                            $phanPhong->lop_id = $sinhVien->lops->malop;
                            $phanPhong->ngaysinh = $sinhVien->ngaysinh;
                            $phanPhong->gioitinh = $sinhVien->gioitinh;
                            // $phanPhong->gioitinh = $sinhVien->gioitinh;

                            $phanPhong->save();
                            $soCho--;
                            $phongHienTai->socho = $soCho; // Cập nhật số chỗ mới cho phòng
                            $phongHienTai->save();

                            // $svDaPhanPhong->push($sinhVien);
                            $svDaPhanPhong[] = $sinhVien->mssv;
                        } else {
                            //$svChuaPhanPhong->push($sinhVien);
                            $svChuaPhanPhong[] = $sinhVien;
                        }
                    }
                }
            }
        }
        // Lấy danh sách sinh viên chưa được phân phòng
        $dotHoc = DotHoc::find($dotHocId);
        $phanDots = $dotHoc->phanDot;
        $lopIds = $phanDots->lop->pluck('id');
        $sinhViens = Sinhvien::whereIn('lop_id', $lopIds)->orderBy('id', 'DESC')
            ->get();
        // Lấy danh sách số thứ tự của sinh viên chưa được phân phòng
        $svChuaPhanPhong = collect();
        $soThuTu = 1;
        foreach ($sinhViens as $sinhVien) {
            if (!in_array($sinhVien->id, $svDaPhanPhong)) {
                $sinhVien->soThuTu = $soThuTu;
                $svChuaPhanPhong->push($sinhVien);
                $soThuTu++;
            }
        }
        $notification = array(
            'message' => 'Phân phòng thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification)->with(['svChuaPhanPhong' => $svChuaPhanPhong]);
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
        $phanPhong = Phanphong::find($id);
        if ($phanPhong) {
            // Xóa thông tin phân phòng
            $phanPhong->delete();
            // Cập nhật số chỗ mới cho phòng
            $phong = Phong::where('id', $phanPhong->phong_id)->first();
            $phong->socho++; // Tăng số chỗ của phòng sau khi xóa sinh viên
            // Lưu thông tin phòng
            $phong->save();
        }
        $notification = array(
            'message' => 'Xóa danh sách phân phòng thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function xoaPhanphong(Request $request)
    {
        if ($request->has('xoa_tat_ca_phan_phong')) {
            // Xóa tất cả phân phòng
            $phanPhongs = Phanphong::all(); // Lấy danh sách tất cả phân phòng
            // Lấy danh sách các phòng chứa sinh viên
            $phongIds = $phanPhongs->pluck('phong_id')->unique();

            // Cập nhật số chỗ mới cho từng phòng
            foreach ($phongIds as $phongId) {
                $soSinhVien = $phanPhongs->where('phong_id', $phongId)->count(); // Đếm số sinh viên trong phòng
                $phong = Phong::find($phongId);
                $phong->socho = $phong->socho + $soSinhVien; // Cộng số sinh viên vào số chỗ của phòng
                $phong->save();
            }
            // Xóa tất cả phân phòng
            Phanphong::truncate();
        } else {
            $ids = $request->input('phanphong_ids');
            // Xóa các phân phòng đã chọn
            $phanPhongs = Phanphong::whereIn('id', $ids)->get();

            // Lấy danh sách các phòng chứa sinh viên
            $phongIds = $phanPhongs->pluck('phong_id')->unique();

            // Cập nhật số chỗ mới cho từng phòng
            foreach ($phongIds as $phongId) {
                $soSinhVien = $phanPhongs->where('phong_id', $phongId)->count(); // Đếm số sinh viên trong phòng
                $phong = Phong::find($phongId);
                $phong->socho = $phong->socho + $soSinhVien; // Cộng số sinh viên vào số chỗ của phòng
                $phong->save();
            }
            // Xóa các phân phòng đã chọn
            Phanphong::whereIn('id', $ids)->delete();
        }

        $notification = array(
            'message' => 'Xóa danh sách phân phòng thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

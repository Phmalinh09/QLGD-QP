<?php

namespace App\Http\Controllers;

use App\Models\Dothoc;
use App\Models\Khoahoc;
use App\Models\Nhieugiangvien;
use App\Models\Nhieukhoa;
use App\Models\Nhieulop;
use App\Models\Phandot;
use App\Models\Phangiangvien;
use App\Models\Phannhieuxe;
use App\Models\Phanphong;
use App\Models\Phanxe;
use App\Models\Phong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DothocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dothocs = $request->input('dot_hoc');
        $khoahoc = $request->input('khoa_hoc');
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $dothoc = Dothoc::orderBy('id', 'DESC')->search($dothocs, $khoahoc)->get();
        return view('admin.dothoc.dothoc')->with(compact('dothoc', 'khoahocs', 'dothocs', 'khoahoc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $khoahocs = DB::table('khoahoc')->where(['trangthai' => 0])->get();
        return view('admin.dothoc.them')->with(compact('khoahocs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                // 'sodot' => 'required',
                'khoahocs' => 'required',
                'trangthai' => 'required',
            ],
            [

                // 'sodot.un' => 'Mã lớp không được bỏ trống',
            ]
        );


        // $data = $request->all();
        // $dothoc = new Dothoc();
        // $data['sodot'] = $request->get('sodot');
        // $sodot_text = $request->input('sodot_text');

        if ($so_luong = $request->input('so_luong')) {
            for ($i = 0; $i < $so_luong; $i++) {
                $data = $request->all();
                $dothoc = new Dothoc();
                $data['sodot'] = 'Đợt' . ' ' . ($i + 1);
                $dothoc->sodot = $data['sodot'];
                $dothoc->khoahoc_id = $data['khoahocs'];
                $dothoc->trangthai = $data['trangthai'];
                $dothoc->save();
            }
            $notification = array(
                'message' => 'Thêm đợt học thành công',
                'alert-type' => 'success'
            );
            return redirect()->back()->withInput()->with($notification);
        } else {
            $data = $request->all();
            $dothoc = new Dothoc();
            $dothoc->sodot = 'Đợt' . ' ' . $data['sodot'];
            $dothoc->khoahoc_id = $data['khoahocs'];
            $dothoc->trangthai = $data['trangthai'];
            $dothoc->save();
        }
        $notification = array(
            'message' => 'Thêm đợt học thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->withInput()->with($notification); //trả về trang mà bn đã gửi dữ liệu cho database
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
        $dothocs = Dothoc::find($id);
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        return view('admin.dothoc.sua')->with(compact('dothocs', 'khoahocs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'sodot' => 'required',
                'khoahocs' => 'required',
                'trangthai' => 'required',
            ],
            [
                'sodot.required' => 'Đợt học không được bỏ trống',
            ]
        );
        //   $data = $request->all();
        $dothoc = Dothoc::find($id);
        $dothoc->sodot = $data['sodot'];
        $dothoc->khoahoc_id = $data['khoahocs'];
        $dothoc->trangthai = $data['trangthai'];
        $dothoc->save();
        $notification = array(
            'message' => 'Cập nhật đợt học thành công',
            'alert-type' => 'success'
        );

        return redirect('admin/dothoc')->with($notification); //trả về trang mà bn đã gửi dữ liệu cho database
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dothocs = Dothoc::find($id);
        Phandot::whereIn('dothoc_id', [$dothocs->id])->delete();
        Phanxe::whereIn('dothoc_id', [$dothocs->id])->delete();
        $phanPhong = Phanphong::whereIn('dothoc_id', [$dothocs->id])->first();

        if ($phanPhong) {
            $phanPhongs = $phanPhong->pluck('phong_id')->unique();

            foreach ($phanPhongs as $phongId) {
                $soSinhVien = $phanPhong->where('phong_id', $phongId)->count(); // Đếm số sinh viên trong phòng
                $phong = Phong::find($phongId);
                $phong->socho = $phong->socho + $soSinhVien; // Cộng số sinh viên vào số chỗ của phòng
                $phong->save();
            }

            $phanPhong->delete();
        }

        Phangiangvien::whereIn('dothoc_id', [$dothocs->id])->delete();
        Dothoc::find($id)->delete();
        $notification = array(
            'message' => 'Xóa đợt học thành công',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function xoaDothoc(Request $request)
    {
        if ($request->has('xoa_tat_ca')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Phandot::truncate();
            Phanxe::truncate();
            //Phanphong::truncate();
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
            Phangiangvien::truncate();
            Nhieugiangvien::truncate();
            Nhieulop::truncate();
            Nhieukhoa::truncate();
            Phannhieuxe::truncate();
            Dothoc::truncate(); // Xóa tất cả dữ liệu trong bảng lớp
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } else {
            $ids = $request->input('dothoc_ids');

            $phanPhongs = Phanphong::whereIn('dothoc_id', $ids)->get();

            // Lấy danh sách các phòng chứa sinh viên
            $phongIds = $phanPhongs->pluck('phong_id')->unique();

            // Cập nhật số chỗ mới cho từng phòng
            foreach ($phongIds as $phongId) {
                $soSinhVien = $phanPhongs->where('phong_id', $phongId)->count(); // Đếm số sinh viên trong phòng
                $phong = Phong::find($phongId);
                $phong->socho += $soSinhVien; // Cộng số sinh viên vào số chỗ của phòng
                $phong->save();
            }

            Phanphong::whereIn('dothoc_id', $ids)->delete(); // Xóa các bản ghi phân phòng được chọn
            Dothoc::whereIn('id', $ids)->delete(); // Xóa các đợt học được chọn

        }
        $notification = array(
            'message' => 'Xóa đợt học thành công',
            'alert-type' => 'success'
        );
        // Redirect hoặc trả về thông báo thành công
        return redirect()->back()->with($notification);
    }
}

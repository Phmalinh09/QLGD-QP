<?php

namespace App\Http\Controllers;

use App\Models\Dothoc;
use App\Models\Khoa;
use App\Models\Khoahoc;
use App\Models\LopModel;
use App\Models\Phanphong;
use App\Models\Phong;
use App\Models\Sinhvien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KhoahocController extends Controller
{
    public function index(Request $request)
    {
       $khoahoc = DB::table('khoahoc');
        $khoahoc= Khoahoc::orderBy('id','DESC')->get();
        return view('admin.khoahoc.khoahoc')->with(compact('khoahoc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.khoahoc.them');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'makhoahoc' => 'required|unique:khoahoc|max:255',
            'nam' => 'required|unique:khoahoc|max:255',
            'trangthai' => 'required',
        ],
        [
            'makhoahoc.unique' => 'Mã khóa đã tồn tại',
            'nam.unique' => 'Tên khóa đã tồn tại',
            'makhoahoc.required' => 'Mã khóa không được bỏ trống',
            'nam.required' => 'Tên khóa không được bỏ trống',
        ]
    );    
       $data = $request->all();
        $khoahoc = new Khoahoc();
        $khoahoc->makhoahoc = $data['makhoahoc'];
        $khoahoc->nam = $data['nam'];
        $khoahoc->trangthai = $data['trangthai'];
        $khoahoc->save();
        $notification = array(
            'message' => 'Thêm khóa học thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);//trả về trang mà bn đã gửi dữ liệu cho database

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
        $khoahocs = Khoahoc::find($id);
        return view('admin.khoahoc.sua')->with(compact('khoahocs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'makhoahoc' => 'required|max:255',
            'nam' => 'required|max:255',
            'trangthai' => 'required',
        ],
        [
            'makhoahoc.required' => 'Mã khóa không được bỏ trống',
            'nam.required' => 'Tên khóa không được bỏ trống',
        ]
    );    
       
        $khoahoc = Khoahoc::find($id);;
        $khoahoc->makhoahoc = $data['makhoahoc'];
        $khoahoc->nam = $data['nam'];
        $khoahoc->trangthai = $data['trangthai'];
        $khoahoc->save();
        $notification = array(
            'message' => 'Cập nhật khóa thành công',
            'alert-type' => 'success'
        );
        return redirect('admin/khoahoc')->with($notification);//trả về tr

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $khoahocs = Khoahoc::find($id);
        LopModel::whereIn('khoahoc_id', [$khoahocs->id])->delete();
        Sinhvien::whereIn('khoahoc_id', [$khoahocs->id])->delete();
        $dothocs = Dothoc::whereIn('khoahoc_id', [$khoahocs->id]);
        $phanPhong = Phanphong::whereIn('dothoc_id', $dothocs->pluck('id'))->first();
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
        $dothocs->delete();
        Khoahoc::find($id)->delete();
        $notification = array(
            'message' => 'Xóa khóa thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
     }
}

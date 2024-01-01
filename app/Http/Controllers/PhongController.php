<?php

namespace App\Http\Controllers;

use App\Models\Phong;
use Illuminate\Http\Request;

class PhongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $sophong = $request->input('so_phong');
        $gioitinh = $request->input('gioi_tinh');
        $phong = Phong::orderBy('id', 'DESC')->search($sophong, $gioitinh)->get();
        $soThuTu1 = 1;
        foreach ($phong as $phongs) {
            $phongs->soThuTu1 = $soThuTu1;
            $soThuTu1++;
        }
        return view('admin.phong.phong')->with(compact('phong', 'sophong', 'gioitinh'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
                // 'sodot' => 'required',
                'tenphong' => 'required|unique:phong',
                'socho' => 'required',
                'gioitinh' => 'required',
            ],
            [

                'tenphong.unique' => 'Tên phòng đã tồn tại',
                'tenphong.required' => 'Tên phòng không được bỏ trống',
                'socho.required' => 'Số chỗ không được bỏ trống',
            ]
        );
        $data = $request->all();
        $phong = new Phong();
        $phong->tenphong = $data['tenphong'];
        $phong->socho = $data['socho'];
        $phong->gioitinh = $data['gioitinh'];
        $phong->save();
        $notification = array(
            'message' => 'Thêm phòng ở thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->withInput()->with($notification);
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
        $phongs = Phong::find($id);
        return view('admin.phong.sua')->with(compact('phongs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'tenphong' => 'required',
                'socho' => 'required',
                'gioitinh' => 'required',
            ],
            [
                'tenphong.unique' => 'Tên phòng đã tồn tại',
                'tenphong.required' => 'Tên phòng không được bỏ trống',
                'socho.required' => 'Số chỗ không được bỏ trống',
            ]
        );
        //   $data = $request->all();
        $phong = Phong::find($id);
        $phong->tenphong = $data['tenphong'];
        $phong->socho = $data['socho'];
        $phong->gioitinh = $data['gioitinh'];
        $phong->save();
        $notification = array(
            'message' => 'Cập nhật phòng ở thành công',
            'alert-type' => 'success'
        );
        return redirect('admin/phong')->with($notification); //trả về trang mà bn đã gửi dữ liệu cho database
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phong = Phong::find($id);
        if ($phong->socho < 8) {
            $notification = array(
                'message' => 'Số phòng này đang có người ở',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $phong->delete();
        $notification = array(
            'message' => 'Xóa phòng ở thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // public function xoaPhongo(Request $request)
    // {
    //     if ($request->has('xoa_tat_ca_phong_o')) {
    //         Phong::truncate(); // Xóa tất cả dữ liệu trong bảng lớp
    //     } else {
    //         $ids = $request->input('phong_ids');
    //         Phong::whereIn('id', $ids)->delete(); // Xóa các lớp được chọn
    //     }

    //     // Redirect hoặc trả về thông báo thành công
    //     $notification = array(
    //         'message' => 'Xóa phòng ở thành công',
    //         'alert-type' => 'success'
    //     );
    //     return redirect()->back()->with($notification);
    // }
    public function xoaPhongo(Request $request)
    {
        if ($request->has('xoa_tat_ca_phong_o')) {
            // Kiểm tra và lọc các phòng có số chỗ hiện tại lớn hơn số chỗ khi chưa được phân phòng
            $phongDangCoNguoiO = Phong::whereRaw('socho < 8')->get();

            if ($phongDangCoNguoiO->count() > 0) {
                $notification = array(
                    'message' => 'Có phòng đang có người ở',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }

            Phong::truncate(); // Xóa tất cả dữ liệu trong bảng phòng
        } else {
            $ids = $request->input('phong_ids');

            // Kiểm tra và lọc các phòng có số chỗ hiện tại lớn hơn số chỗ khi chưa được phân phòng
            $phongDangCoNguoiO = Phong::whereIn('id', $ids)
                ->whereRaw('socho < 8')
                ->get();

            if ($phongDangCoNguoiO->count() > 0) {
                $notification = array(
                    'message' => 'Có phòng đang có người ở',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }

            Phong::whereIn('id', $ids)->delete(); // Xóa các phòng được chọn
        }

        // Redirect hoặc trả về thông báo thành công
        $notification = array(
            'message' => 'Xóa phòng ở thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

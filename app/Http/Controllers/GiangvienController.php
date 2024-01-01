<?php

namespace App\Http\Controllers;

use App\Models\Giangvien;
use App\Models\Phangiangvien;
use Illuminate\Http\Request;

class GiangvienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tengv = $request->input('ten_gv');
        $trangthai = $request->input('trang_thai');
        $giangvien = Giangvien::orderBy('id','DESC')->search($tengv,$trangthai)->get();
        return view('admin.giangvien.giangvien')->with(compact('giangvien','tengv','trangthai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.giangvien.them');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tengv' => 'required|max:255',
            'email' => 'required|max:255',
            'sdt' => 'required|max:255',
            'trangthai' => 'required',
        ],
        [
            'tengv.required' => 'Tên giảng viên không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'sdt.required' => 'Số điện thoại không được bỏ trống',

        ]
    );    
       $data = $request->all();
        $giangvien = new Giangvien();
        $giangvien->tengv = $data['tengv'];
        $giangvien->email = $data['email'];
        $giangvien->sdt = $data['sdt'];
        $giangvien->trangthai = $data['trangthai'];
        $giangvien->save();
        $notification = array(
            'message' => 'Thêm giảng viên thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);//trả về trang mà bn đã gửi dữ liệu cho database

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $giangviens = Giangvien::find($id);
            return view('admin.giangvien.sua')->with(compact('giangviens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'tengv' => 'required|max:255',
            'email' => 'required|max:255',
            'sdt' => 'required|max:255',
            'trangthai' => 'required',
        ],
        [
            'tengv.required' => 'Tên giảng viên không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'sdt.required' => 'Số điện thoại không được bỏ trống',
        ]
    );    
       //$data = $request->all();
        $giangvien = Giangvien::find($id);//update du lieu dua tren id
        $giangvien->tengv = $data['tengv'];
        $giangvien->email = $data['email'];
        $giangvien->sdt = $data['sdt'];
        $giangvien->trangthai = $data['trangthai'];
        $giangvien->save();
        $notification = array(
            'message' => 'Cập nhật Giảng viên thành công',
            'alert-type' => 'success'
        );
        return redirect('admin/giangvien')->with($notification);//trả về trang mà bn đã gửi dữ liệu cho database

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $giangvien=Giangvien::find($id);
        Phangiangvien::whereIn('giangvien_id', [$giangvien->id])->delete();
        Giangvien::find($id)->delete();
        $notification = array(
            'message' => 'Xóa giảng viên thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

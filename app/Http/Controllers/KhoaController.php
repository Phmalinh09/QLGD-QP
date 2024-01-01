<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use Illuminate\Http\Request;

class KhoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $khoa = Khoa::orderBy('id','DESC')->search()->get();
        return view('admin.khoa.khoa')->with(compact('khoa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.khoa.them');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'makhoa' => 'required|unique:khoas|max:255',
            'tenkhoa' => 'required|unique:khoas|max:255',
            //'slug_khoa' => 'required|unique:khoas|max:255',
            'mota' => 'max:255',
            'trangthai' => 'required',
        ],
        [
            'makhoa.unique' => 'Mã khoa đã tồn tại',
            'tenkhoa.unique' => 'Tên khoa đã tồn tại',
           // 'slug_khoa.unique' => 'Slug khoa đã tồn tại',
            'makhoa.required' => 'Mã khoa không được bỏ trống',
            'tenkhoa.required' => 'Tên khoa không được bỏ trống',
            'mota.max' => 'Số từ quá giới hạn.',
        ]
    );    
       $data = $request->all();
        $khoa = new Khoa();
        $khoa->makhoa = $data['makhoa'];
        $khoa->tenkhoa = $data['tenkhoa'];
       // $khoa->slug_khoa = $data['slug_khoa'];
        $khoa->truongkhoa = $data['truongkhoa'];
        $khoa->ngaythanhlap = $data['ngaythanhlap'];
        $khoa->mota = $data['mota'];
        $khoa->trangthai = $data['trangthai'];
        $khoa->save();
        $notification = array(
            'message' => 'Thêm khoa thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification );//trả về trang mà bn đã gửi dữ liệu cho database

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
        {
            $khoas = Khoa::find($id);
            return view('admin.khoa.sua')->with(compact('khoas'));
         }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'makhoa' => 'required|max:255',
            'tenkhoa' => 'required|max:255',
            'trangthai' => 'required',
            'truongkhoa' => '',
            'ngaythanhlap' => '',
            'mota' => 'max:255',
            //'slug_khoa' => 'required|max:255',
        ],
        [
            'makhoa.unique' => 'Mã khoa đã tồn tại',
            'tenkhoa.unique' => 'Tên khoa đã tồn tại',
            'makhoa.required' => 'Mã khoa không được bỏ trống',
            'tenkhoa.required' => 'Tên khoa không được bỏ trống',
          //  'truongkhoa.required' => 'Trưởng khoa không được bỏ trống',
            'mota.max' => 'Số từ quá giới hạn.',
        ]
    );    
       //$data = $request->all();
        $khoa = Khoa::find($id);//update du lieu dua tren id
        $khoa->makhoa = $data['makhoa'];
        $khoa->tenkhoa = $data['tenkhoa'];
       // $khoa->slug_khoa = $data['slug_khoa'];
        $khoa->truongkhoa = $data['truongkhoa'];
        $khoa->ngaythanhlap = $data['ngaythanhlap'];
        $khoa->mota = $data['mota'];
        $khoa->trangthai = $data['trangthai'];
        $khoa->save();
        $notification = array(
            'message' => 'Cập nhật khoa thành công',
            'alert-type' => 'success'
        );
        return redirect('admin/khoa')->with($notification);//trả về trang mà bn đã gửi dữ liệu cho database

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Khoa::find($id)->delete();
        $notification = array(
            'message' => 'Xóa khoa thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
     }

}

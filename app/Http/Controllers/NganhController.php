<?php

namespace App\Http\Controllers;

use App\Models\Khoa;
use App\Models\Nganh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NganhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $khoas= Khoa::orderBy('id','DESC')->get();
        $nganh= Nganh::orderBy('id','DESC')->search()->get();
        return view('admin.nganh.nganh')->with(compact('nganh','khoas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $khoas = Khoa::orderBy('id', 'DESC')->get();
        $khoas = DB::table('khoas')->where(['trangthai' => 0])->get();
        return view('admin.nganh.them')->with(compact('khoas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'manganh' => 'required|unique:nganhs|max:255',
            'tennganh' => 'required|unique:nganhs|max:255',
            'trangthai' => 'required',
            'khoas' => 'required',

        ],
        [
            'makhoa.unique' => 'Mã ngành đã tồn tại',
            'tenkhoa.unique' => 'Tên ngành đã tồn tại',
            //'manganh.unique' => 'Mã ngành đã tồn tại',           
            'manganh.required' => 'Mã ngành không được bỏ trống',
            'tennganh.required' => 'Tên ngành không được bỏ trống',
            
        ]
    );    
       $data = $request->all();
        $nganh = new Nganh();
        $nganh->manganh = $data['manganh'];
        $nganh->tennganh = $data['tennganh'];
        $nganh->khoa_id = $data['khoas'];
        $nganh->trangthai = $data['trangthai'];
        $nganh->save();
        $notification = array(
            'message' => 'Thêm ngành thành công',
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
        $khoas = Khoa::orderBy('id', 'DESC')->get();
        $nganhs = Nganh::find($id);
        return view('admin.nganh.sua')->with(compact('nganhs','khoas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'manganh' => 'required|max:255',
            'tennganh' => 'required|max:255',
            'trangthai' => 'required',
            'khoas' => 'required',
        ],
        [
            'makhoa.unique' => 'Mã ngành đã tồn tại',
            'tenkhoa.unique' => 'Tên ngành đã tồn tại',            
            'manganh.required' => 'Mã ngành không được bỏ trống',
            'tennganh.required' => 'Tên ngành không được bỏ trống',
        ]
    );    
       //$data = $request->all();
        $nganh = Nganh::find($id);//update du lieu dua tren id
        $nganh->manganh = $data['manganh'];
        $nganh->tennganh = $data['tennganh'];
        $nganh->khoa_id = $data['khoas'];
        $nganh->trangthai = $data['trangthai'];
        $nganh->save();
        $notification = array(
            'message' => 'Cập nhật ngành thành công',
            'alert-type' => 'success'
        );
        return redirect('admin/nganh')->with($notification);//trả về trang mà bn đã gửi dữ liệu cho database
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Nganh::find($id)->delete();
        $notification = array(
            'message' => 'Xóa ngành thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

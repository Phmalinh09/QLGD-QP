<?php

namespace App\Http\Controllers;


use App\Models\Chuyennganh;
use App\Models\LopModel;
use App\Models\Khoa;
use App\Models\Nienkhoa;
use App\Models\Nganh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\Imports;
use App\Exports\ExcelExports;
use App\Exports\MaulopExport;
use App\Imports\ExcelImports;
use App\Models\Khoahoc;
use App\Models\Sinhvien;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;

class LopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //     $lops = DB::table('lops');
        //     $chuyennganhs = DB::table('chuyennganhs')->get();
        //    $khoas = DB::table('khoas')->get();
        //    $nganhs = DB::table('nganhs')->get();
        //$lop = LopModel::withCount('gioitinh','Nam')->get();

        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $khoas = Khoa::orderBy('id', 'DESC')->get();
        $nganhs = Nganh::orderBy('id', 'DESC')->get();


        $malop = $request->input('ma_lop');
        $khoa = $request->input('khoa_ly');
        $khoahoc = $request->input('khoa_hoc');
        $lops = LopModel::with('khoas', 'khoahocs', 'nganhs')->orderBy('id', 'DESC')->search($malop, $khoa, $khoahoc)->get();
        foreach ($lops as $lopss) {
            $tongsinhviens = $lopss->getSinhvienCounts();
            $lopss->tong_sinhvien = $tongsinhviens['tong_sinhvien'];
            $lopss->tong_nam = $tongsinhviens['tong_nam'];
            $lopss->tong_nu = $tongsinhviens['tong_nu'];
        }


        // if ($request->has('xoa_tat_ca')) {
        //     LopModel::truncate(); // Xóa tất cả dữ liệu trong bảng lớp
        // } else {
        //     $lop[] = $request->input('lops');
        //     LopModel::whereIn('id', $lop)->delete(); // Xóa các lớp được chọn
        // }
        $soThuTu1 = 1;
        foreach ($lops as $lop) {
            $lop->soThuTu1 = $soThuTu1;
            $soThuTu1++;
        }

        return view('admin.lop.lop')->with(compact('lops', 'khoas', 'nganhs', 'khoahocs', 'malop', 'khoa', 'khoahoc'));
        // return view('admin.lop.lop',['lops' => $lops,'khoas' => $khoas, 'chuyennganhs'=>$chuyennganhs,'nganhs'=>$nganhs]);
    }

    public function getNganh(Request $request)
    {
        $nganh_id = $request->input('nganh_id');
        $nganhs = Nganh::where('khoa_id', $nganh_id)->get();
        return response()->json($nganhs);
    }
    public function getLop(Request $request)
    {
        $khoahoc_id = $request->input('khoahoc_id');
        $lopss = LopModel::where('khoahoc_id', $khoahoc_id)->get();
        return response()->json($lopss);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $khoahocs = DB::table('khoahoc')->where(['trangthai' => 0])->get();
        $khoas = Khoa::orderBy('id', 'DESC')->get();
        $khoas = DB::table('khoas')->where(['trangthai' => 0])->get();
        $nganhs = Nganh::orderBy('id', 'DESC')->get();
        $nganhs = DB::table('nganhs')->where(['trangthai' => 0])->get();
        return view('admin.lop.them')->with(compact('khoas',  'nganhs', 'khoahocs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'malop' => 'unique:lops',
                    'khoas' => 'required',
                    'nganhs' => 'required',
                    'khoahocs' => 'required',
                    'trangthai' => 'required',
                ],
                [
                    'malop.unique' => 'Mã lớp đã tồn tại',
                ]
            );
            if ($so_luong = $request->input('so_luong')) {
                $malop_text = $request->input('malop_text');
                for ($i = 0; $i < $so_luong; $i++) {
                    $data = $request->all();
                    $lop = new LopModel();
                    $data['malop'] = $malop_text . ($i + 1);

                    $lop->malop = $data['malop'];
                    $lop->khoa_id = $data['khoas'];
                    $lop->nganh_id = $data['nganhs'];
                    $lop->khoahoc_id = $data['khoahocs'];
                    $lop->trangthai = $data['trangthai'];
                    $lop->save();
                }
                $notification = array(
                    'message' => 'Thêm lớp thành công',
                    'alert-type' => 'success'
                );
                return redirect()->back()->withInput()->with($notification); //trả về trang mà bn đã gửi dữ liệu cho database
            } else {
                $data = $request->all();
                $lop = new LopModel();
                $lop->malop = $data['malop'];
                $lop->khoa_id = $data['khoas'];
                $lop->nganh_id = $data['nganhs'];
                $lop->khoahoc_id = $data['khoahocs'];
                $lop->trangthai = $data['trangthai'];
                $lop->save();
            }
            $notification = array(
                'message' => 'Thêm lớp thành công',
                'alert-type' => 'success'
            );
            return redirect()->back()->withInput()->with($notification); //trả về trang mà bn đã gửi dữ liệu cho database
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1048) {
                $errorMessage = "error: Trường 'malop' không thể để trống.";                
                return redirect()->back()->withInput()->withErrors([$errorMessage]);
            }
        }
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
        $lops = LopModel::find($id);
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $khoas = Khoa::orderBy('id', 'DESC')->get();
        $nganhs = Nganh::orderBy('id', 'DESC')->get();
        return view('admin.lop.sua')->with(compact('khoas', 'lops', 'nganhs', 'khoahocs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'malop' => 'required|max:255',
                'khoas' => 'required',
                'nganhs' => 'required',
                'khoahocs' => 'required',
                'trangthai' => 'required',
            ],
            [
                'malop.required' => 'Mã lớp không được bỏ trống',
            ]
        );
        //   $data = $request->all();
        $lop = LopModel::find($id);
        $lop->malop = $data['malop'];
        $lop->khoa_id = $data['khoas'];
        $lop->nganh_id = $data['nganhs'];
        $lop->khoahoc_id = $data['khoahocs'];
        $lop->trangthai = $data['trangthai'];
        $lop->save();
        $notification = array(
            'message' => 'Cập nhật lớp thành công',
            'alert-type' => 'success'
        );
        return redirect('admin/lop')->with($notification); //trả về trang mà bn đã gửi dữ liệu cho database
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $lops = LopModel::find($id);
        Sinhvien::whereIn('lop_id', [$lops->id])->delete();
        LopModel::find($id)->delete();
        $notification = array(
            'message' => 'Xóa lớp thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function export()
    {
        return Excel::download(new ExcelExports, 'lop.xlsx');
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
            Excel::import(new ExcelImports(), $request->file('import_file'));
            $notification = array(
                'message' => 'Tải lên thành công',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } catch (\Exception $e) {
            // Lưu thông báo lỗi vào session
            Session::flash('error', 'Lỗi khi tải lên dữ liệu : ' . $e->getMessage() . ' ' . 'không xác định');
        }

        // Chuyển hướng về trang views
        return redirect()->back();
    }

    // public function xemlop(Request $request, $id)
    // {
    //     $mssv = $request->input('ms_sv');
    //     $ten = $request->input('ho_ten');
    //     $lop = $request->input('lop_hoc');
    //     $khoahoc = $request->input('khoa_hoc');
    //     $khoas = Khoa::orderBy('id', 'DESC')->get();
    //     $nganhs = Nganh::orderBy('id', 'DESC')->get();
    //     $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
    //     $lops = LopModel::with('khoas',  'nganhs')->where('id', $id)->where('trangthai', 0)->first();
    //     $sinhviens = Sinhvien::with('lops')->orderBy('id', 'ASC')->where('lop_id', $lops->id)->orderBy('id', 'DESC')->search($mssv, $ten, $lop, $khoahoc)->get();
    //     return view('admin.lop.xemlop')->with(compact('khoas', 'nganhs', 'lops', 'sinhviens', 'khoahocs', 'mssv', 'ten', 'lop', 'khoahoc'));
    // }
    // public  function delete_select(Request $request){
    //     $ids = $request->ids;
    //     LopModel::whereIn('id',$ids)->delete();
    //     return redirect()->back()->with('status', 'Xóa lớp thành công');
    // }


    public function xoaLop(Request $request)
    {
        if ($request->has('xoa_tat_ca')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Sinhvien::truncate();
            LopModel::truncate(); // Xóa tất cả dữ liệu trong bảng lớp
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } else {
            $ids = $request->input('lop_ids');
            LopModel::whereIn('id', $ids)->delete(); // Xóa các lớp được chọn
        }
        $notification = array(
            'message' => 'Xóa lớp thành công',
            'alert-type' => 'success'
        );
        // Redirect hoặc trả về thông báo thành công
        return redirect()->back()->with($notification);
    }
    public function MauLopExport(){
        return Excel::download(new MaulopExport, 'File_Mau_Lop.xlsx');
    }
}

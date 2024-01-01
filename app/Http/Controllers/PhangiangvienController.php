<?php

namespace App\Http\Controllers;

use App\Models\Dothoc;
use App\Models\Giangvien;
use App\Models\Khoa;
use App\Models\Khoahoc;
use App\Models\LopModel;
use App\Models\Phandot;
use App\Models\Phangiangvien;
use App\Models\Phannhieuxe;
use App\Models\Phanxe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhangiangvienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $giangvien = $request->input('giang_vien');
        $khoahoc = $request->input('dot_hoc');


        $phangiangvien = Phangiangvien::search($giangvien, $khoahoc)->get();
        $phandots = Phandot::orderBy('id', 'DESC')->get();
        $giangviens = Giangvien::orderBy('id', 'DESC')->get();
        $lops = LopModel::orderBy('id', 'DESC')->get();
        $khoas = Khoa::orderBy('id', 'DESC')->get();
        //  $khoas = Khoa::pluck('tenkhoa', 'id');
        $khoahocs = Khoahoc::orderBy('id', 'DESC')->get();
        $dothocs = Dothoc::orderBy('id', 'DESC')->get();
        $phanxe = Phanxe::with('dothocs', 'khoahocs')->orderBy('id', 'DESC')->get();
        $soxeduynhat = PhanXe::pluck('so_xe')->unique();
        //dd($soxeduynhat);
        $soThuTu1 = 1;
        foreach ($phangiangvien as $phangiangviens) {
            $phangiangviens->soThuTu1 = $soThuTu1;
            $soThuTu1++;
        }
        return view('admin.phanxe.phangiangvien')->with(compact('phangiangvien','khoahoc','giangvien', 'giangviens', 'dothocs', 'khoahocs', 'khoas', 'lops', 'phandots', 'phanxe', 'soxeduynhat'));
    }


    public function getGiaovien(Request $request)
    {
        $dotHocs = $request->input('dothoc_id');
        $dotHoc = Dothoc::find($dotHocs);
        
        $phanDots = $dotHoc->phanDot;

            $giangviens = $phanDots->giangvien;
            return response()->json($giangviens);

    }

    public function getSoxe(Request $request)
    {
        $dotHocs = $request->input('dothoc_id');
        $dotHoc = Dothoc::findOrFail($dotHocs);
        if ($dotHoc !== null) {
            $phanXe = DB::table('phanxe')
                ->select('so_xe')
                ->where('dothoc_id', $dotHoc->id)
                ->distinct()
                ->get();
            return response()->json($phanXe);
        } else {
            // Trả về thông báo lỗi dưới dạng JSON
            return response()->json(['error' => 'Không có kết quả truy vấn hoặc giá trị null']);
        }


    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
                'giangviens' => 'required',
                'so_xe' => 'required',
            ],
            [
                'dothocs.required' => 'Đợt học không được bỏ trống',
                'khoahocs.required' => 'Khóa học không được bỏ trống',
                'giangviens.required' => 'Giảng viên không được bỏ trống',
                'so_xe.required' => 'Số xe không được bỏ trống',
            ]
        );
        $data = $request->all();
        $phangiangvien = new Phangiangvien();
        $phangiangvien->khoahoc_id = $data['khoahocs'];
        $phangiangvien->dothoc_id = $data['dothocs'];
        $phangiangvien->giangvien_id = $data['giangviens'];
        // $phangiangvien->so_xe = $data['so_xe'];
        // Liên kết giảng viên với các số xe đã chọn
        foreach ($data['so_xe'] as $soXe) {
            $phangiangvien->so_xe = $soXe[0];
        }
        $phangiangvien->save();
        $phangiangvien->phanXe()->attach($data['so_xe']);
        $notification = array(
            'message' => 'Phân giảng viên phụ trách thành công.',
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
        $phangiangvien = Phangiangvien::find($id);
        Phannhieuxe::whereIn('phangiangvien_id', [$phangiangvien->id])->delete();
        Phangiangvien::find($id)->delete();
        $notification = array(
            'message' => 'Xóa đợt phân giảng viên thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function xoaPhangiangvien(Request $request)
    {
        if ($request->has('xoa_tat_ca_phan_giang_vien')) {
            // Vô hiệu hóa ràng buộc khóa ngoại
            Phannhieuxe::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Phangiangvien::truncate(); // Xóa tất cả dữ liệu trong bảng lớp        
            // Bật lại ràng buộc khóa ngoại
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } else {
            $ids = $request->input('phangiangvien_ids');
            Phangiangvien::whereIn('id', $ids)->delete(); // Xóa các lớp được chọn
        }

        // Redirect hoặc trả về thông báo thành công
        $notification = array(
            'message' => 'Xóa đợt phân giảng viên thành công.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

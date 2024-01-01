<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use App\Models\Khoa;
use App\Models\Khoahoc;
use App\Models\LopModel;
use App\Models\Sinhvien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SinhvienEmports implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        $sinhvienData = Sinhvien::select('id','mssv', 'hodem','ten','gioitinh','ngaysinh','dienthoai','lop_id','khoahoc_id')->orderBy('id','Desc')->get();
       // $sinhvienData = Sinhvien::select('id','mssv', 'hodem','ten',DB::raw('IF((sinhviens.gioitinh = 0),"Nam","Nữ") as gioitinh'),'ngaysinh','dienthoai','lop_id','khoa_id','dotthucte','dottheokehoach')->where('trangthai',0)->orderBy('id','Desc')->get();
        //$sinhvienData=DB::table('sinhviens as e')->raw('IF((sinhviens.gioitinh = 0),"Nam","Nữ") as gioitinh');
        foreach($sinhvienData as $key => $sinhvien){
            $khoahoc = Khoahoc::select('makhoahoc')->where('id',$sinhvien->khoahoc_id)->first();
            $sinhvienData[$key]->khoahoc_id = $khoahoc->makhoahoc;
            $lop = LopModel::select('malop')->where('id',$sinhvien->lop_id)->first();
            $sinhvienData[$key]->lop_id = $lop->malop;       
            // if($sinhvienData[$key]->gioitinh = 0){
            //     $sinhvienData=Sinhvien::select('gioitinh')->where('gioitinh','Nam')->first();
            // }else{
            //     $sinhvienData=Sinhvien::select('gioitinh')->where('gioitinh','Nữ')->first();
            // }
            
        }
        return $sinhvienData;
    }
    public function headings() : array
    {
        return[
            'STT',
            'Mã HS-SV',
            'Họ đệm',
            'Tên',
            'Giới tính',
            'Ngày sinh',
            'Điện thoại',
            'Lớp học',
            'Khoa học',
        ];
    }
}

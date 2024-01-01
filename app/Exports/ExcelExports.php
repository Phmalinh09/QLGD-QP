<?php

namespace App\Exports;

use App\Models\Chuyennganh;
use App\Models\Khoa;
use App\Models\Khoahoc;
use App\Models\Lop;
use App\Models\LopModel;
use App\Models\Nganh;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExports implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $lopData = LopModel::select('id','malop','tong','tongnam','tongnu','khoahoc_id','nganh_id','khoa_id')->where('trangthai',0)->orderBy('id','Desc')->get();
        foreach($lopData as $key => $lop){
            $khoa = Khoa::select('tenkhoa')->where('id',$lop->khoa_id)->first();
            $lopData[$key]->khoa_id = $khoa->tenkhoa;
            $nganh = Nganh::select('tennganh')->where('id',$lop->nganh_id)->first();
            $lopData[$key]->nganh_id = $nganh->tennganh;
            $khoahoc = Khoahoc::select('makhoahoc')->where('id',$lop->khoahoc_id)->first();
            $lopData[$key]->khoahoc_id = $khoahoc->makhoahoc;
        }
        return $lopData;
    }
    public function headings() : array
    {
        return[
            'STT',
            'Mã lớp',
            'Tổng sinh viên',
            'Tổng nam',
            'Tổng nữ',
            'Khóa học',
            'Khoa chủ quản',
            'Ngành',

        ];
    }
}

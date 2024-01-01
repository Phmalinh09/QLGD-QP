<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MauSinhvienExport implements WithHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return collect([]);
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
            'Khóa học',
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\LopModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaulopExport implements WithHeadings, FromCollection
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
            'Mã lớp học',
            'Khóa học',
            'Khoa chủ quản',
            'Ngành',
        ];
    }
}

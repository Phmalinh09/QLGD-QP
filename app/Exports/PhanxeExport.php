<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PhanxeExport implements WithHeadings, FromCollection

{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public $filteredSinhViens;
    public $dotHoc;
    public $gv;
    
   // protected $data;

   public function __construct($filteredSinhViens, $dotHoc, $gv)
    {
        $this->filteredSinhViens = $filteredSinhViens;
        $this->dotHoc = $dotHoc;
        $this->gv = $gv;
    }
   public function collection()
    {
        return collect($this->filteredSinhViens);
    }
    public function headings(): array
    {
        return [
            [
                'Đợt học - ' . $this->dotHoc,
            ],
            // $this->gv[0] ? [
            //     'Thầy/Cô phụ trách - ' . implode(', ', (array)($this->gv[0])),
            // ] : [],
            [
                'Thầy/Cô phụ trách  - ' . implode(', ', (array)$this->gv[0]),
            ],
            // [
            //     'Thầy/Cô phụ trách  - ' . $this->gv,
            // ],
            [
                'ID',
                'Mã HS-SV',
                'Họ đệm',
                'Tên',
                'Giới tính',
                'Ngày sinh',
                'Điện thoại',
                'Lớp học',
                'Khoa học',
                'Trang thái',
                'Ghi chú',
                'Số xe',
                'Số phòng',
                'STT',
            ],
            [],
        ];
    }
}

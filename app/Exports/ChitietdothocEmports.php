<?php

namespace App\Exports;

use App\Models\Khoahoc;
use App\Models\LopModel;
use App\Models\Phandot;
use App\Models\Sinhvien;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

use PhpOffice\PhpSpreadsheet\IOFactory;

class ChitietdothocEmports implements WithHeadings, FromCollection
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

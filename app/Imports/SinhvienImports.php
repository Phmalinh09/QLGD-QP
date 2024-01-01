<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use App\Models\Khoa;
use App\Models\Khoahoc;
use App\Models\LopModel;
use App\Models\Sinhvien;
use Exception;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SinhvienImports implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable;
    private $khoahocs;
    private $lops;
    // private $gioitinhs;
    public function __construct()
    {
        $this->khoahocs = Khoahoc::all(['id', 'makhoahoc'])->pluck('id', 'makhoahoc');
        $this->lops = LopModel::all(['id', 'malop'])->pluck('id', 'malop');
        // $this->gioitinhs = Sinhvien::where(['sinhviens','gioitinh'])->SetCellValue('0','Nam')->SetCellValue('1','Nữ');
        //SetCellValue
        // $this->gioitinhs = DB::raw('IF((sinhviens.gioitinh = 0),"Nam","Nữ") as gioitinh');
        // $this->gioitinhs = DB::table('sinhviens')->where(['id','gioitinh'])->raw('IF((sinhviens.gioitinh = 0),"Nam","Nữ") as gioitinh')->pluck('id','gioitinh');
    }
    public function model(array $row)
    {
        $errorMessages = [
            'undefined_key' => "'%s' không tồn tại.",
            // Thêm các thông báo lỗi khác tại đây nếu cần thiết
        ];
        try {
            if (is_null($this->lops[$row['lop_hoc']])) {
                $errorMessage = sprintf($errorMessages['undefined_key'], $row['lop_hoc']);
                throw new Exception($errorMessage);
            }
            if (is_null($this->khoahocs[$row['khoa_hoc']])) {
                $errorMessage = sprintf($errorMessages['undefined_key'], $row['khoa_hoc']);
                throw new Exception($errorMessage);
            }
            return new Sinhvien([
                'id' => $row['stt'],
                'mssv' => $row['ma_hs_sv'],
                'hodem' => $row['ho_dem'],
                'ten' => $row['ten'],
                'gioitinh' => $row['gioi_tinh'],
                'ngaysinh' => $row['ngay_sinh'],
                'dienthoai' => $row['dien_thoai'],
                'lop_id' => isset($this->lops[$row['lop_hoc']]) ? $this->lops[$row['lop_hoc']] : null,
                'khoahoc_id' => isset($this->khoahocs[$row['khoa_hoc']]) ? $this->khoahocs[$row['khoa_hoc']] : null,
                'trangthai' => 'Hoạt động'
            ]);
        } catch (\Exception $e) {
            // Ghi log lỗi và hiển thị thông báo lỗi
            Log::error('Lỗi khi import dữ liệu: ' . $e->getMessage());
            throw new \Exception(' ' . $e->getMessage());
        }
    }
    public function chunkSize(): int
    {
        return 5000;
    }
}

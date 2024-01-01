<?php

namespace App\Imports;

use App\Models\Chuyennganh;
use App\Models\Khoa;
use App\Models\Khoahoc;
use App\Models\LopModel;
use App\Models\Nganh;
use Exception;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\ValidationException;

class ExcelImports implements ToModel, WithHeadingRow, WithChunkReading
{
    
    use Importable;
    private $khoas;
    private $nganhs;
    private $khoahocs;
    public function __construct()
    {
        $this->khoas = Khoa::all(['id', 'tenkhoa'])->pluck('id', 'tenkhoa');
        $this->nganhs = Nganh::all(['id', 'tennganh'])->pluck('id', 'tennganh');
        $this->khoahocs = Khoahoc::all(['id', 'makhoahoc'])->pluck('id', 'makhoahoc');
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $errorMessages = [];
    public function model(array $row)
    {
        // if (!isset($row['khoa_chu_quan'])) {
        //     $this->errorMessages[] = 'Trường khóa chủ quản không được xác định.';
        //     return null;
        // }
        // return new LopModel([
        //     //            
        //     'id'=>$row['stt'],
        //     'malop'=>$row['ma_lop_hoc'],
        //     'tong'=>0,
        //     'tongnam'=>0,
        //     'tongnu'=>0,
        //     'khoahoc_id'=>$this->khoahocs[$row['khoa_hoc']],
        //     'khoa_id'=>$this->khoas[$row['khoa_chu_quan']],
        //     'nganh_id'=>$this->nganhs[$row['nganh']],
        //     'trangthai'=>0
        // ]);




        $errorMessages = [
            'undefined_key' => "'%s' không tồn tại.",
            // Thêm các thông báo lỗi khác tại đây nếu cần thiết
        ];
        try {
            if (is_null($this->khoas[$row['khoa_chu_quan']])) {
                $errorMessage = sprintf($errorMessages['undefined_key'], $row['khoa_chu_quan']);
                throw new Exception($errorMessage);
            }
            if (is_null($this->khoahocs[$row['khoa_hoc']])) {
                $errorMessage = sprintf($errorMessages['undefined_key'], $row['khoa_hoc']);
                throw new Exception($errorMessage);
            }
            if (is_null($this->nganhs[$row['nganh']])) {
                $errorMessage = sprintf($errorMessages['undefined_key'], $row['nganh']);
                throw new Exception($errorMessage);
            }
            
            return new LopModel([
                'id' => $row['stt'],
                'malop' => $row['ma_lop_hoc'],
                'tong' => 0,
                'tongnam' => 0,
                'tongnu' => 0,
                'khoahoc_id' => isset($this->khoahocs[$row['khoa_hoc']]) ? $this->khoahocs[$row['khoa_hoc']] : null,
                'khoa_id' => isset($this->khoas[$row['khoa_chu_quan']]) ? $this->khoas[$row['khoa_chu_quan']] : null,
                'nganh_id' => isset($this->nganhs[$row['nganh']]) ? $this->nganhs[$row['nganh']] : null,
                'trangthai' => 0
            ]);
        } catch (\Exception $e) {
            // Ghi log lỗi và hiển thị thông báo lỗi
            Log::error('Lỗi khi import dữ liệu: ' . $e->getMessage());
            throw new \Exception(' ' . $e->getMessage());
        }
    }
    public function getErrorMessages()
{
    return $this->errorMessages;
}
    
    public function chunkSize(): int
    {
        return 5000;
    }
}

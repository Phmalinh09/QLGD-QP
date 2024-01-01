<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LopModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'malop', 'nganh_id', 'khoa_id', 'trangthai', 'khoahoc_id', 'tong', 'tongnam', 'tongnu'
    ];
    protected $primaryKey = 'id';
    protected $table = 'lops';
    public function nganhs()
    {
        return $this->belongsTo('App\Models\Nganh', 'nganh_id', 'id');
    }
    public function khoas()
    {
        return $this->belongsTo('App\Models\Khoa', 'khoa_id', 'id');
    }
    public function khoahocs()
    {
        return $this->belongsTo('App\Models\Khoahoc', 'khoahoc_id', 'id');
    }
    public function sinhvien()
    {
        return $this->hasMany('App\Models\Sinhvien', 'lop_id', 'id');
    }
    public function phanDots()
    {
        return $this->belongsToMany(Phandot::class, 'nhieulop', 'lop_id', 'phandot_id');
    }
    // public function scopeSearch($query)
    // {
    //     if ($key = request()->malop) {
    //         $query = $query->where('malop', 'like', '%' . $key . '%');
    //     } else if ($key = request()->khoa) {
    //         $query = $query->where('khoa_id', '=', $key);
    //     } else if ($key = request()->khoahoc) {
    //         $query = $query->where('khoahoc_id', '=', $key);
    //     }
    //     return $query;
    // }


    public function scopeSearch($query, $malop, $khoa, $khoahoc)
    {
        return $query->when($malop, function ($query) use ($malop) {
            return $query->where('malop', 'LIKE', '%' . $malop . '%');
        })
            ->when($khoa, function ($query) use ($khoa) {
                return $query->where('khoa_id', $khoa);
            })
            ->when($khoahoc, function ($query) use ($khoahoc) {
                return $query->where('khoahoc_id', $khoahoc);
            });
    }



    public function getSinhvienCounts()
    {
        //$sinhviens = Sinhvien::all();
        $tongs = $this->sinhvien()->count();
        $tongnams = $this->sinhvien()->where('gioitinh', 'Nam')->count();
        $tongnus = $this->sinhvien()->where('gioitinh', 'Nữ')->count();
        $this->tong = $tongs;
        $this->tongnam = $tongnams;
        $this->tongnu = $tongnus;
        $this->save();
        return [
            'tong_sinhvien' => $tongs,
            'tong_nam' => $tongnams,
            'tong_nu' => $tongnus,
        ];
    }
    // protected $appends = ['SttSinhvien'];
    // public function getSttSinhvienAttribute()
    // {
    //     // Tính toán và trả về số thứ tự sinh viên
    //     // Ví dụ: Sử dụng phương thức orderBy('id') để xác định số thứ tự
    //     return $this->sinhvien()->orderBy('id')->get()->search(function ($sinhvien) {
    //         return $sinhvien->id === $this->sinhvien->id;
    //     }) + 1;
    // }

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phanxe extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'khoahoc_id', 'hosv', 'tensv', 'gioitinh', 'ngaysinh', 'dothoc_id', 'lop_id', 'trangthai', 'sinhvien_id', 'so_xe','mssv'
    ];
    protected $primaryKey = 'id';
    protected $table = 'phanxe';
    public function khoahocs()
    {
        return $this->belongsTo('App\Models\Khoahoc', 'khoahoc_id', 'id');
    }
    public function dothocs()
    {
        return $this->belongsTo('App\Models\Dothoc', 'dothoc_id', 'id');
    }
    // public function lops()
    // {
    //     return $this->belongsTo('App\Models\LopModel', 'lop_id', 'id');
    // }
    // public function giangviens()
    // {
    //     return 
    //     $this->belongsTo('App\Models\Giangvien', 'giangvien_id', 'id');
    // }
    public function sinhviens()
    {
        return $this->belongsTo('App\Models\Sinhvien', 'sinhvien_id', 'id');
    }
    public function phanGiangVien()
    {
        return $this->belongsToMany(PhanGiangVien::class, 'phannhieuxe', 'phangiangvien_id', 'so_xe_id');
    }
    public function scopeSearch($query, $soxe, $dothoc, $ten, $lop, $mssv)
    {
        return $query->when($soxe, function ($query) use ($soxe) {
            return $query->where('so_xe',  $soxe);
        })
            ->when($ten, function ($query) use ($ten) {
                return $query->where('tensv', 'LIKE', '%' . $ten . '%');
            })
            ->when($lop, function ($query) use ($lop) {
                return $query->where('lop_id', $lop);
            })
            ->when($mssv, function ($query) use ($mssv) {
                return $query->where('sinhvien_id', 'LIKE', '%' . $mssv . '%');
            })
            ->when($dothoc, function ($query) use ($dothoc) {
                return $query->where('dothoc_id', $dothoc);
            });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phanphong extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'khoahoc_id', 'dothoc_id', 'sinhvien_id', 'phong_id','tenphong','hosv','tensv','lop_id','ngaysinh','gioitinh','mssv'
    ];
    protected $primaryKey = 'id';
    protected $table = 'phanphong';
    public function khoaHoc()
    {
        return $this->belongsTo(Khoahoc::class);
    }

    public function dotHoc()
    {
        return $this->belongsTo(Dothoc::class);
    }
    public function khoahocs()
    {
        return $this->belongsTo('App\Models\Khoahoc', 'khoahoc_id', 'id');
    }
    public function dothocs()
    {
        return $this->belongsTo('App\Models\Dothoc', 'dothoc_id', 'id');
    }
    public function lops()
    {
        return $this->belongsTo('App\Models\LopModel', 'lop_id', 'id');
    }
    public function sinhVien()
    {
        return $this->belongsTo(Sinhvien::class, 'id', 'sinhvien_id');
    }
    public function phong()
    {
        return $this->belongsTo(Phong::class);
    }
    public function scopeSearch($query, $sophong, $dothoc, $ten, $mssvs)
    {
        return $query->when($sophong, function ($query) use ($sophong) {
            return $query->where('tenphong',  $sophong);
        })
            
            ->when($mssvs, function ($query) use ($mssvs) {
                return $query->where('mssv', 'LIKE', '%' . $mssvs . '%');
            })
            ->when($dothoc, function ($query) use ($dothoc) {
                return $query->where('dothoc_id', $dothoc);
            })->when($ten, function ($query) use ($ten) {
                return $query->where('tensv', 'LIKE', '%' . $ten . '%');
            });
    }
}

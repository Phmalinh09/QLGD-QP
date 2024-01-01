<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phandot extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'khoahoc_id', 'giangvien_id', 'dothoc_id', 'tong_sv', 'tong_nam', 'tong_nu', 'tg_batdau', 'tg_ketthuc', 'lop_id', 'trangthai', 'khoa_id', 'ghichu'
    ];
    protected $primaryKey = 'id';
    protected $table = 'phandot';
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
    public function giangviens()
    {
        return $this->belongsTo('App\Models\Giangvien', 'giangvien_id', 'id');
    }
    public function khoas()
    {
        return $this->belongsTo('App\Models\Khoa', 'khoa_id', 'id');
    }
    public function conhieukhoa()
    {
        return $this->belongsToMany(Khoa::class, 'nhieukhoa', 'phandot_id', 'khoa_id');
    }
    public function conhieulop()
    {
        return $this->belongsToMany(LopModel::class, 'nhieulop', 'phandot_id', 'lop_id');
    }
    public function conhieugiangvien()
    {
        return $this->belongsToMany(Giangvien::class, 'nhieugiangvien', 'phandot_id', 'giangvien_id');
    }
    public function khoa()
    {
        return $this->belongsToMany(Khoa::class, 'nhieukhoa');
    }
    public function lop()
    {
        return $this->belongsToMany(LopModel::class, 'nhieulop', 'phandot_id', 'lop_id');
    }
    public function giangvien()
    {
        return $this->belongsToMany(Giangvien::class, 'nhieugiangvien', 'phandot_id', 'giangvien_id');
    }
    public function phanXe()
    {
        return $this->hasMany(Phanxe::class, 'phandot_id');
    }
    public function phanXess()
    {
        return $this->hasMany(Phanxe::class, 'dothoc_id');
    }

    public function getDotHoc($khoaHocID)
    {
        $dotHocs  = DotHoc::where('khoahoc_id', $khoaHocID)->get();

        return response()->json($dotHocs);
    }


    public function scopeSearch($query, $dothoc, $khoahoc)
    {
        return $query->when($dothoc, function ($query) use ($dothoc) {
            return $query->where('dothoc_id', $dothoc);
        })
            ->when($khoahoc, function ($query) use ($khoahoc) {
                return $query->where('khoahoc_id', $khoahoc);
            });
    }
}

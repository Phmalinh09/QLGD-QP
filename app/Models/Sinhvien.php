<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinhvien extends Model
{
    use HasFactory;
    protected $fillable = [
        'mssv', 'hodem', 'ten', 'gioitinh', 'ngaysinh', 'lop_id', 'dienthoai', 'khoahoc_id', 'trangthai','ghichu','so_xe','so_phong','soThuTu1','soDotHoc','tengiangvien_sdt_pairs',
    ];
    protected $primaryKey = 'id';
    protected $table = 'sinhviens';
    public function lops()
    {
        return $this->belongsTo('App\Models\LopModel', 'lop_id', 'id');
    }
    public function khoahocs()
    {
        return $this->belongsTo('App\Models\Khoahoc', 'khoahoc_id', 'id');
    }

    public function phanxe()
    {
        return $this->hasOne(Phanxe::class, 'sinhvien_id', 'id');
    }
    public function phanphong()
    {
        return $this->hasOne(Phanphong::class, 'sinhvien_id', 'id');
    }

    // public function scopeSearch( $query)
    // {

    //     if($key = request()->mssv){
    //         $query = $query->where('mssv','like','%'.$key.'%');           
    //     }
    //     else if($key = request()->ten){
    //         $query = $query->where('ten','like','%'.$key.'%');           
    //     }
    //     else if($key = request()->lop){
    //         $query = $query->where('lop_id','like','%'.$key.'%');   

    //     }
    //     else if ($key = request()->khoa){            
    //         $query = $query->where('khoahoc_id','like','%'.$key.'%');           
    //     }

    //       return $query;     
    //  }

    public function scopeSearch($query, $mssv, $ten, $lop, $khoahoc, $trangthai)
    {
        return $query->when($mssv, function ($query) use ($mssv) {
            return $query->where('mssv', 'LIKE', '%' . $mssv . '%');
        })
            ->when($ten, function ($query) use ($ten) {
                return $query->where('ten', 'LIKE', '%' . $ten . '%');
            })
            ->when($lop, function ($query) use ($lop) {
                return $query->where('lop_id', $lop);
            })
            ->when($trangthai, function ($query) use ($trangthai) {
                return $query->where('trangthai', $trangthai);
            })
            ->when($khoahoc, function ($query) use ($khoahoc) {
                return $query->where('khoahoc_id', $khoahoc);
            });
    }


    protected $appends = ['sttsinhvien'];
    //sắp xếp số thứ tự sinh viên
    public function getSttSinhvienAttribute()
    {
        $lop = $this->lops;
        $sinhviens = $lop->sinhvien()->orderBy('id')->pluck('id')->toArray();
        $sinhvienIndex = array_search($this->id, $sinhviens);
        return $sinhvienIndex !== false ? $sinhvienIndex + 1 : null;
    }
}

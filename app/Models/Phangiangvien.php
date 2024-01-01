<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phangiangvien extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'khoahoc_id', 'giangvien_id', 'dothoc_id', 'so_xe'
    ];
    protected $primaryKey = 'id';
    protected $table = 'phangiangvien';
    public function khoahocs()
    {
        return $this->belongsTo('App\Models\Khoahoc', 'khoahoc_id', 'id');
    }
    public function dothocs()
    {
        return $this->belongsTo('App\Models\Dothoc', 'dothoc_id', 'id');
    }
    public function giangviens()
    {
        return $this->belongsTo('App\Models\Giangvien', 'giangvien_id', 'id');
    }
    public function soxe()
    {
        return $this->belongsTo('App\Models\PhanXe', 'so_xe', 'id');
    }
    public function phanNhieuXe()
    {
        return $this->hasMany(PhanNhieuXe::class);
    }
    public function phanXe()
    {
        return $this->belongsToMany(Phanxe::class, 'phannhieuxe', 'phangiangvien_id', 'so_xe_id');
    }
    public function phanxess()
    {
        return $this->belongsToMany(Phanxe::class, 'phannhieuxe', 'phangiangvien_id', 'so_xe_id');
    }
    public function phanNhieuXes()
    {
        return $this->hasOne(Phannhieuxe::class,  'phangiangvien_id', 'id');
    }


    public function scopeSearch($query, $giangvien, $khoahoc)
    {
        return $query->when($giangvien, function ($query) use ($giangvien) {
            return $query->where('giangvien_id', $giangvien);
        })
            ->when($khoahoc, function ($query) use ($khoahoc) {
                return $query->where('dothoc_id', $khoahoc);
            });
    }
}

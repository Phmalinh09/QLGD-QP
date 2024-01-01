<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giangvien extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
         'tengv','email','sdt','trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'giangviens';
    public function phanDots()
    {
        return $this->belongsToMany(Phandot::class, 'nhieugiangvien', 'giangvien_id', 'phandot_id');
    }
    public function phanXe()
    {
        return $this->belongsToMany(Phangiangvien::class, 'phannhieuxe', 'phangiangvien_id', 'so_xe_id');
    }
    public function phanGiangvien()
    {
        return $this->hasOne(Phangiangvien::class, 'giangvien_id', 'id');
    }

    public function scopeSearch($query, $tengv, $trangthai)
    {
        return $query->when($tengv, function ($query) use ($tengv) {
            return $query->where('tengv', 'LIKE', '%' . $tengv . '%');
        })
            ->when($trangthai, function ($query) use ($trangthai) {
                return $query->where('trangthai', $trangthai);
            });
    }

}

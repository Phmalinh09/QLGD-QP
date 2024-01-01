<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phannhieuxe extends Model
{
    use HasFactory;
    protected $fillable = [
        'phangiangvien_id', 'so_xe_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'phannhieuxe';
    public function phanGiangVien()
    {
        return $this->belongsTo(PhanGiangVien::class, 'phangiangvien_id');
    }
    public function phanXe()
    {
        return $this->belongsTo(PhanXe::class, 'so_xe_id');
    }
}

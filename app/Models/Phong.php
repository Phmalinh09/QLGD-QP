<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'tenphong', 'socho','gioitinh'
    ];
    protected $primaryKey = 'id';
    protected $table = 'phong';
    public function phong()
    {
        return $this->hasMany(Phanphong::class);
    }
    public function scopeSearch($query, $sophong, $gioitinh)
    {
        return $query->when($sophong, function ($query) use ($sophong) {
            return $query->where('tenphong', $sophong);
        })
            ->when($gioitinh, function ($query) use ($gioitinh) {
                return $query->where('gioitinh', $gioitinh);
            });
    }
}

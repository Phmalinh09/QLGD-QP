<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'makhoa', 'tenkhoa','slug_khoa', 'truongkhoa','ngaythanhlap','mota','trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'khoas';

    //thêm localScope
    public function scopeSearch($query)
    {
        if($makhoa = request()->makhoa){
            $query = $query->where('makhoa','like','%'.$makhoa.'%');           
        }
        if($tenkhoa = request()->tenkhoa){
            $query = $query->where('tenkhoa','like','%'.$tenkhoa.'%'); 
        }
        return $query;
    }
    public function lops(){
        return $this->hasMany('App\Models\LopModel','khoa_id');
    }
    public function phanDots()
{
    return $this->belongsToMany(Phandot::class, 'nhieukhoa', 'khoa_id', 'phandot_id');
}
}

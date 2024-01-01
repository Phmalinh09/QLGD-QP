<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nganh extends Model
{
    use HasFactory;
    protected $fillable = [
        'manganh', 'tennganh','trangthai','khoa_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'nganhs';
    public function khoas()
    {
        return $this->belongsTo('App\Models\Khoa', 'khoa_id', 'id');
    }
    public function scopeSearch($query)
    {
        if($manganh = request()->manganh){
            $query = $query->where('manganh','like','%'.$manganh.'%');           
        }
        if($tenganh = request()->tennganh){
            $query = $query->where('tennganh','like','%'.$tenganh.'%'); 
        }
        return $query;
    }
}

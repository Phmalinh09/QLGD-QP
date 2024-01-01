<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoahoc extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'makhoahoc', 'nam','trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'khoahoc';
    public function dothocs(){
        return $this->hasMany('App\Models\Dothoc','khoahoc_id');
    }
}

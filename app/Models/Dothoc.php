<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dothoc extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'khoahoc_id', 'sodot','trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'dothoc';
    public function khoahocs()
    {
        return $this->belongsTo('App\Models\Khoahoc', 'khoahoc_id', 'id');
    }
    public function phanDot()
    {
        return $this->hasOne(PhanDot::class, 'dothoc_id');
    }
    public function phanXe()
    {
        return $this->hasMany(Phanxe::class, 'dothoc_id');
    }

    public function scopeSearch($query, $dothoc, $khoahoc)
    {
        return $query->when($dothoc, function ($query) use ($dothoc) {
            return $query->where('sodot', 'LIKE', '%' . $dothoc . '%');
        })
            ->when($khoahoc, function ($query) use ($khoahoc) {
                return $query->where('khoahoc_id', $khoahoc);
            });
    }
}

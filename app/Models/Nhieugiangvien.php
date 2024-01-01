<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhieugiangvien extends Model
{
    use HasFactory;
    protected $fillable = [
        'phandot_id','giangvien_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'nhieugiangvien';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhieulop extends Model
{
    use HasFactory;
    protected $fillable = [
        'phandot_id','lop_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'nhieulop';
}

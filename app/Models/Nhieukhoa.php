<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhieukhoa extends Model
{
    use HasFactory;
    protected $fillable = [
        'phandot_id','khoa_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'nhieukhoa';
}

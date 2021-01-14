<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khuyenmai extends Model
{
    use HasFactory;
    protected $table = 'khuyen_mai';
    public $primaryKey = 'ma_km';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thanhvien extends Model
{
    use HasFactory;
    protected $table = 'thanh_vien';
    public $primaryKey = 'ma_tv';
}

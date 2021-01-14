<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhgia extends Model
{
    use HasFactory;
    protected $table = 'danh_gia';
    public function thanhvien()
    {
        return $this->belongsTo('App\Models\thanhvien', 'ma_tv', 'ma_tv');
    }
}

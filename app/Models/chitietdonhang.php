<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chitietdonhang extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_don_hang';
    public function sanpham()
    {
        return $this->belongsTo('App\Models\sanpham', 'ma_sp', 'ma_sp');
    }
    public function donhang()
    {
        return $this->belongsTo('App\Models\donhang', 'ma_dh', 'ma_dh');
    }
}

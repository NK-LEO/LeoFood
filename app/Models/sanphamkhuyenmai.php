<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sanphamkhuyenmai extends Model
{
    use HasFactory;
    protected $table = 'san_pham_khuyen_mai';
    // protected $primaryKey = ['ma_km', 'ma_sp'];
    // public $incrementing = false;
    public function khuyenmai()
    {
        return $this->belongsTo('App\Models\khuyenmai', 'ma_km', 'ma_km');
    }
    public function sanpham()
    {
        return $this->belongsTo('App\Models\sanpham', 'ma_sp', 'ma_sp');
    }
}

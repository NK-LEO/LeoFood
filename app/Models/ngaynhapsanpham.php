<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ngaynhapsanpham extends Model
{
    use HasFactory;
    protected $table = 'ngay_nhap_sp';
    public $timestamps = false;
    public function sanpham()
    {
        return $this->belongsTo('App\Models\sanpham', 'ma_sp', 'ma_sp');
    }
}

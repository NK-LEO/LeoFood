<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    use HasFactory;
    protected $table = 'san_pham';
    public $primaryKey = 'ma_sp';
    protected $fillable = [
        'ten_sp',
        'hinh_sp',
        'chitiet_sp',
        'gia_sp',
        'soluong_sp',
        'ma_loaisp'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thanhphandinhduong extends Model
{
    use HasFactory;
    protected $table = 'thanh_phan_dinh_duong';
    public $primaryKey = 'ma_tpdd';
}

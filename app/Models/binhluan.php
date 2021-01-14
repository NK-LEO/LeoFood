<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class binhluan extends Model
{
    use HasFactory;
    protected $table = 'binh_luan';
    public $primaryKey = 'ma_bl';
    public function thanhvien()
    {
        return $this->belongsTo('App\Models\thanhvien', 'ma_tv', 'ma_tv');
    }
}

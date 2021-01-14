<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phanhoi extends Model
{
    use HasFactory;
    protected $table = 'phan_hoi';
    public function thanhvien()
    {
        return $this->belongsTo('App\Models\thanhvien', 'ma_tv', 'ma_tv');
    }
}

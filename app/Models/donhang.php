<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donhang extends Model
{
    use HasFactory;
    protected $table = 'don_hang';
    public $primaryKey = 'ma_dh';
    public function chitietdonhang()
    {
        return $this->hasOne('App\Models\chitietdonhang', 'ma_dh', 'ma_dh');
    }
}

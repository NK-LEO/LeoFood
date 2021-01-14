<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tinhthanhpho extends Model
{
    use HasFactory;
    protected $table = 'devvn_tinhthanhpho';
    public $primaryKey = 'matp';
}

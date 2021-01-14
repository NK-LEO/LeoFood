<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slideshow extends Model
{
    use HasFactory;
    protected $table = 'slideshow';
    public $primaryKey = 'ma_slides';
}

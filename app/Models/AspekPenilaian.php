<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspekPenilaian extends Model
{
    use HasFactory;

    protected $table = "aspek_penilaian";

    protected $guarded = [''];

    public $timestamps = false;
}

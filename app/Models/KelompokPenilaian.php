<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokPenilaian extends Model
{
    use HasFactory;

    protected $table = "kelompok_penilaian";

    protected $guarded = [''];

    public $timestamps = false;
}

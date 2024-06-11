<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = "siswa";

    protected $guarded = [''];

    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, "kelasId");
    }

    public function wali()
    {
        return $this->belongsTo(User::class, "waliId");
    }
}

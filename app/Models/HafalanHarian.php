<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HafalanHarian extends Model
{
    use HasFactory;

    protected $table = "hafalan";

    protected $guarded = [''];

    public $timestamps = false;

    public function guru()
    {
        return $this->belongsTo(Guru::class, "guruId");
    }

    public function materi()
    {
        return $this->belongsTo(Pelajaran::class, "materiId");
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, "siswaId");
    }
}

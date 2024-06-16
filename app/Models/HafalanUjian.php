<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HafalanUjian extends Model
{
    use HasFactory;

    protected $table = "hafalan_ujian";

    protected $guarded = [''];

    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, "siswaId");
    }

    public function materiPelajaran()
    {
        return $this->belongsTo(Pelajaran::class, "materiId");
    }

    public function kelompokPenilaian()
    {
        return $this->belongsTo(KelompokPenilaian::class, "kelompokPenilaianId");
    }
}

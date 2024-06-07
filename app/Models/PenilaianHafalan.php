<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianHafalan extends Model
{
    use HasFactory;

    protected $table = "penilaian_hafalan";

    protected $guarded = [''];

    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, "siswaId");
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, "pelajaranId");
    }
}

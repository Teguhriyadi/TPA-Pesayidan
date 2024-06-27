<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbilNilai extends Model
{
    use HasFactory;

    protected $table = "ambil_nilai";

    protected $guarded = [''];

    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, "siswa_id");
    }

    public function kelompokPenilaian()
    {
        return $this->belongsTo(KelompokPenilaian::class, "kelompok_penilaian_id");
    }
}

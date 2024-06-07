<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKelas extends Model
{
    use HasFactory;

    protected $table = "jadwal_kelas";

    protected $guarded = [''];

    public $timestamps = false;

    public function kelasPelajaran()
    {
        return $this->belongsTo(KelasPelajaran::class, "kelasPelajaranId", "id");
    }
}

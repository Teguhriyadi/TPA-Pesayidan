<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = "nilai";

    protected $guarded = [''];

    public $timestamps = false;

    public function jadwal()
    {
        return $this->belongsTo(JadwalKelas::class, "jadwal_id");
    }
}

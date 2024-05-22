<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    use HasFactory;

    protected $table = "wali_kelas";

    protected $guarded = [''];

    public $timestamps = false;

    public function guru()
    {
        return $this->belongsTo(Guru::class, "guru_id");
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, "kelas_id");
    }
}

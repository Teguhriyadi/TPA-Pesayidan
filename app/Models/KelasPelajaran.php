<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasPelajaran extends Model
{
    use HasFactory;

    protected $table = "kelas_pelajaran";

    protected $guarded = [''];

    public $timestamps = false;

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, "pelajaran_id", "id");
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, "kelas_id", "id");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapot extends Model
{
    use HasFactory;

    protected $table = "rapot";

    protected $guarded = [''];

    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, "siswa_id");
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, "kelas_id");
    }

    public function guru()
    {
        return $this->belongsTo(User::class, "guru_id");
    }
}

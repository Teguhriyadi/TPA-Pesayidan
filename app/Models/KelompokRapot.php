<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokRapot extends Model
{
    use HasFactory;

    protected $table = "kelompok_rapot";

    protected $guarded = [''];

    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, "kategoriId");
    }
}

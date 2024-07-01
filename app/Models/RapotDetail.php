<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapotDetail extends Model
{
    use HasFactory;

    protected $table = "rapot_detail";

    protected $guarded = [''];

    public $timestamps = false;

    public function kelompokRapot()
    {
        return $this->belongsTo(KelompokRapot::class, "kelompok_rapot_id");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingPertemuan extends Model
{
    use HasFactory;

    protected $table = "setting_pertemuan";

    protected $guarded = [''];

    public $timestamps = false;

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, "tahunAjaranId");
    }
}

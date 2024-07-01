<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [''];

    public function guru()
    {
        return $this->belongsTo(Guru::class, "guruId");
    }

    public function hasGuru()
    {
        return $this->hasOne(Guru::class, "userId", "id");
    }

    public function hasWakel()
    {
        return $this->belongsTo(WaliKelas::class, "guruId");
    }

    public function hasWali()
    {
        return $this->hasOne(Siswa::class, "waliId", "id");
    }

    public function countWali()
    {
        return $this->hasMany(Siswa::class, "waliId", "id");
    }

    public function getActivePhoneNumberAttribute()
    {
        return $this->countWali()->first()->nomorHpAktif ?? null;
    }
}

<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    protected $siswa;

    public function __construct()
    {
        $this->siswa = new Siswa();
    }

    public function run(): void
    {
        $this->siswa->create([
            "nama" => "Aisyah",
            "jenisKelamin" => "L",
            "tempatLahir" => "Bandung",
            "tanggalLahir" => "2018-10-10",
            "alamat" => "Jakarta Raya",
            "pendaftarId" => 1,
            "kelasId" => 1,
            "aktif" => 1,
            "waliId" => 7,
            "nomorHpAktif" => "085324237299",
            "tanggalDaftar" => date("Y-m-d H:i:s")
        ]);

        $this->siswa->create([
            "nama" => "Romlah",
            "jenisKelamin" => "L",
            "tempatLahir" => "Bandung",
            "tanggalLahir" => "2018-10-10",
            "alamat" => "Jakarta Raya",
            "pendaftarId" => 1,
            "kelasId" => 1,
            "aktif" => 1,
            "waliId" => 6,
            "nomorHpAktif" => "085324237299",
            "tanggalDaftar" => date("Y-m-d H:i:s")
        ]);
    }
}

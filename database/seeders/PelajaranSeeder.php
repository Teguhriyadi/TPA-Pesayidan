<?php

namespace Database\Seeders;

use App\Models\Pelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelajaranSeeder extends Seeder
{
    protected $pelajaran;

    public function __construct()
    {
        $this->pelajaran = new Pelajaran();
    }

    public function run(): void
    {
        $this->pelajaran->create([
            "kode" => "PLJR-001",
            "nama" => "Niat Sholat",
            "kelompokPenilaianId" => 1
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-002",
            "nama" => "Do'A Iftitah",
            "kelompokPenilaianId" => 1
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-003",
            "nama" => "Tasbih Ruku'",
            "kelompokPenilaianId" => 1
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-004",
            "nama" => "Do'A I'tidal",
            "kelompokPenilaianId" => 1
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-005",
            "nama" => "Do'A Bangun Tidur",
            "kelompokPenilaianId" => 2
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-006",
            "nama" => "Do'a Masuk WC",
            "kelompokPenilaianId" => 2
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-007",
            "nama" => "Do'a Keluar WC",
            "kelompokPenilaianId" => 2
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-008",
            "nama" => "Do'a Bercermin",
            "kelompokPenilaianId" => 2
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-009",
            "nama" => "Surat Al Fatihah",
            "kelompokPenilaianId" => 3
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-010",
            "nama" => "Surat An Nas",
            "kelompokPenilaianId" => 3
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-011",
            "nama" => "Surat Al - Falaq",
            "kelompokPenilaianId" => 3
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-012",
            "nama" => "Surat Al Ikhlash",
            "kelompokPenilaianId" => 3
        ]);
    }
}

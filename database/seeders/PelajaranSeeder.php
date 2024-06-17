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
            "nama" => "Hafalan Surat - Surat Pendek",
            "kategori" => "Pelajaran",
            "kelompokPelajaranId" => 5
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-002",
            "nama" => "Calistung",
            "kategori" => "Pelajaran",
            "kelompokPelajaranId" => 5
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-003",
            "nama" => "Aqidah Akhlaq",
            "kategori" => "Pelajaran",
            "kelompokPelajaranId" => 5
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-004",
            "nama" => "Fiqih",
            "kategori" => "Pelajaran",
            "kelompokPelajaranId" => 5
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-005",
            "nama" => "Do'A Bangun Tidur",
            "kategori" => "Hafalan",
            "kelompokPenilaianId" => 2,
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-006",
            "nama" => "Do'a Masuk WC",
            "kategori" => "Hafalan",
            "kelompokPenilaianId" => 2
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-007",
            "nama" => "Do'a Keluar WC",
            "kategori" => "Hafalan",
            "kelompokPenilaianId" => 2
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-008",
            "nama" => "Do'a Bercermin",
            "kategori" => "Hafalan",
            "kelompokPenilaianId" => 2
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-009",
            "nama" => "Memakai Pakaian",
            "kategori" => "Hafalan",
            "kelompokPenilaianId" => 2
        ]);

        $this->pelajaran->create([
            "kode" => "PLJR-010",
            "nama" => "Melepas Pakaian",
            "kategori" => "Hafalan",
            "kelompokPenilaianId" => 2
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\KelompokRapot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelompokRapotSeeder extends Seeder
{
    protected $kelompokRapot;

    public function __construct()
    {
        $this->kelompokRapot = new KelompokRapot();
    }

    public function run(): void
    {
        $this->kelompokRapot->create([
            "kategoriId" => 1,
            "nama_kelompok_rapot" => "Metode"
        ]);

        $this->kelompokRapot->create([
            "kategoriId" => 1,
            "nama_kelompok_rapot" => "Tajwid"
        ]);

        $this->kelompokRapot->create([
            "kategoriId" => 2,
            "nama_kelompok_rapot" => "Hafalan Surat - Surat Pendek"
        ]);

        $this->kelompokRapot->create([
            "kategoriId" => 2,
            "nama_kelompok_rapot" => "Hafalan Do'A Sehari - Hari"
        ]);

        $this->kelompokRapot->create([
            "kategoriId" => 2,
            "nama_kelompok_rapot" => "Hafalan Bacaan Solat"
        ]);

        $this->kelompokRapot->create([
            "kategoriId" => 2,
            "nama_kelompok_rapot" => "Tahsinul Kitabah"
        ]);

        $this->kelompokRapot->create([
            "kategoriId" => 2,
            "nama_kelompok_rapot" => "Fiqih"
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\KelompokPenilaian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelompokPenilaianSeeder extends Seeder
{
    protected $kelompokPenilaian;

    public function __construct()
    {
        $this->kelompokPenilaian = new KelompokPenilaian();
    }

    public function run(): void
    {
        $this->kelompokPenilaian->create([
            "kelompok" => "Praktek Ibadah",
            "slug" => "praktek-ibadah",
            "kategori" => "Ujian"
        ]);

        $this->kelompokPenilaian->create([
            "kelompok" => "Tahfidz Do'A Harian",
            "slug" => "tahfidz-doa-harian",
            "kategori" => "Ujian"
        ]);

        $this->kelompokPenilaian->create([
            "kelompok" => "Tahfidz Juz'Amma",
            "slug" => "tahfidz-juz-amma",
            "kategori" => "Ujian"
        ]);

        $this->kelompokPenilaian->create([
            "kelompok" => "Surat Pilihan",
            "slug" => "surat-pilihan",
            "kategori" => "Ujian"
        ]);

        $this->kelompokPenilaian->create([
            "kelompok" => "Materi Pelajaran",
            "slug" => "materi-pelajaran",
            "kategori" => "Pelajaran"
        ]);
    }
}

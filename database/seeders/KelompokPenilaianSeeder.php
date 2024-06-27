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
            "slug" => "praktek-ibadah"
        ]);

        $this->kelompokPenilaian->create([
            "kelompok" => "Tahfidz Do'A Harian",
            "slug" => "tahfidz-doa-harian"
        ]);

        $this->kelompokPenilaian->create([
            "kelompok" => "Tahfidz Juz'Amma",
            "slug" => "tahfidz-juz-amma"
        ]);

        $this->kelompokPenilaian->create([
            "kelompok" => "Surat Pilihan",
            "slug" => "surat-pilihan"
        ]);

        $this->kelompokPenilaian->create([
            "kelompok" => "Iqro / Jilid",
            "slug" => "iqro-jilid"
        ]);
    }
}

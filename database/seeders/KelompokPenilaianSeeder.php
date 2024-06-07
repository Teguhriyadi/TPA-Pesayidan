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
            "kelompok" => "Praktek Ibadah"
        ]);

        $this->kelompokPenilaian->create([
            "kelompok" => "Tahfidz Do'A Harian"
        ]);

        $this->kelompokPenilaian->create([
            "kelompok" => "Tahfidz Juz'Amma"
        ]);

        $this->kelompokPenilaian->create([
            "kelompok" => "Surat Pilihan"
        ]);
    }
}

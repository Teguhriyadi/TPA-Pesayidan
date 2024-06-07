<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    protected $kelas;

    public function __construct()
    {
        $this->kelas = new Kelas();
    }

    public function run(): void
    {
        $this->kelas->create([
            "namaKelas" => "Ceria 1",
            "jenjang" => "TK",
            "deskripsi" => "TK Ceria Nih"
        ]);

        $this->kelas->create([
            "namaKelas" => "Bahagia Selalu",
            "jenjang" => "TPA",
            "deskripsi" => "TPA Always Bahagia"
        ]);

        $this->kelas->create([
            "namaKelas" => "Sehat Sehat Orang Baik",
            "jenjang" => "TPA",
            "deskripsi" => "TPA Mengutamakan Orang Sehat"
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\KelasPelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasPelajaranSeeder extends Seeder
{
    protected $kelasPelajaran;

    public function __construct()
    {
        $this->kelasPelajaran = new KelasPelajaran();
    }

    public function run(): void
    {
        $this->kelasPelajaran->create([
            "tahun_ajaran_id" => 1,
            "pelajaran_id" => 1,
            "kelas_id" => 1
        ]);

        $this->kelasPelajaran->create([
            "tahun_ajaran_id" => 1,
            "pelajaran_id" => 2,
            "kelas_id" => 2
        ]);
    }
}

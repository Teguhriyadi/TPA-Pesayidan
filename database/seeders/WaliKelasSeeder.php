<?php

namespace Database\Seeders;

use App\Models\WaliKelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaliKelasSeeder extends Seeder
{
    protected $waliKelas;

    public function __construct()
    {
        $this->waliKelas = new WaliKelas();
    }

    public function run(): void
    {
        $this->waliKelas->create([
            "guru_id" => 1,
            "kelas_id" => 1,
            "tahun_ajaran_id" => 1,
            "status" => 1
        ]);
    }
}

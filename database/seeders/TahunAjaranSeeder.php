<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    protected $tahunAjaran;

    public function __construct()
    {
        $this->tahunAjaran = new TahunAjaran();
    }

    public function run(): void
    {
        $this->tahunAjaran->create([
            "tahun_ajaran" => "2024",
            "status" => "1"
        ]);

        $this->tahunAjaran->create([
            "tahun_ajaran" => "2025",
            "status" => "0"
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\SiswaJenjang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaJenjangSeeder extends Seeder
{
    protected $siswaJenjang;

    public function __construct()
    {
        $this->siswaJenjang = new SiswaJenjang();
    }

    public function run(): void
    {
        $this->siswaJenjang->create([
            "siswaId" => 1,
            "kelasId" => 1,
            "tahunAjaranId" => 1,
            "status" => 1
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new Kategori();
    }

    public function run(): void
    {
        $this->kategori->create([
            "nama_kategori" => "MENGAJI",
        ]);

        $this->kategori->create([
            "nama_kategori" => "MATERI PELAJARAN"
        ]);
    }
}

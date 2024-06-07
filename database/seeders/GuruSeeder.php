<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    protected $guru;

    public function __construct()
    {
        $this->guru = new Guru();
    }

    public function run(): void
    {
        $this->guru->create([
            "userId" => 2,
            "nip" => "29092002",
            "jenisKelamin" => "P",
            "tempatLahir" => "Cirebon",
            "tanggalLahir" => "2002-10-10",
            "alamat" => "Universitas Catur Insan Cendikia",
            "validasiId" => 1
        ]);

        $this->guru->create([
            "userId" => 3,
            "nip" => "29092003",
            "jenisKelamin" => "P",
            "tempatLahir" => "Cirebon",
            "tanggalLahir" => "2002-10-11",
            "alamat" => "Universitas Catur Insan Cendikia",
            "validasiId" => 1
        ]);

        $this->guru->create([
            "userId" => 4,
            "nip" => "29092004",
            "jenisKelamin" => "P",
            "tempatLahir" => "Cirebon",
            "tanggalLahir" => "2002-10-11",
            "alamat" => "Universitas Catur Insan Cendikia",
            "validasiId" => 1
        ]);
    }
}

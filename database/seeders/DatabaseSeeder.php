<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TahunAjaranSeeder::class,
            KategoriSeeder::class,
            GuruSeeder::class,
            KelasSeeder::class,
            PelajaranSeeder::class,
            KelompokPenilaianSeeder::class,
            SiswaSeeder::class,
            SiswaJenjangSeeder::class,
            WaliKelasSeeder::class,
            KelompokRapotSeeder::class
        ]);
    }
}

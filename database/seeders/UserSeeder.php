<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function run(): void
    {
        $this->user->create([
            "nama" => "Administrator",
            "username" => "admin",
            "password" => bcrypt("password"),
            "akses" => "ADMIN",
            "status" => 1
        ]);

        $this->user->create([
            "nama" => "Zahrina",
            "username" => "zahrin",
            "password" => bcrypt("zahrina123"),
            "akses" => "GURU",
            "status" => 1
        ]);

        $this->user->create([
            "nama" => "Zahra",
            "username" => "zahra",
            "password" => bcrypt("zahra123"),
            "akses" => "GURU",
            "status" => 1
        ]);

        $this->user->create([
            "nama" => "Aiziah",
            "username" => "aiziah",
            "password" => bcrypt("aiziah123"),
            "akses" => "GURU",
            "status" => 1
        ]);

        $this->user->create([
            "username" => "wakel-aiziah",
            "password" => bcrypt("wakel-aiziah"),
            "akses" => "WAKEL",
            "status" => 1,
            "guruId" => 5
        ]);

        $this->user->create([
            "nama" => "Aiziah Bernard",
            "username" => "ortu-hamdan",
            "password" => bcrypt("ortu123"),
            "akses" => "ORTU",
            "status" => 1
        ]);

        $this->user->create([
            "nama" => "Rahani",
            "username" => "ortu-bernard",
            "password" => bcrypt("ortu12345"),
            "akses" => "ORTU",
            "status" => 1
        ]);
    }
}

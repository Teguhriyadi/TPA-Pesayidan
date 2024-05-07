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
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Pelajaran;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    protected $siswa, $guru, $waliKelas, $pelajaran;

    public function __construct()
    {
        $this->siswa = new Siswa();
        $this->guru = new Guru();
        $this->waliKelas =new WaliKelas();
        $this->pelajaran = new Pelajaran();
    }

    public function dashboard()
    {
        if (Auth::user()->akses == "ADMIN") {

            $data = [
                "siswa" => $this->siswa->where("aktif", "1")->count(),
                "guru" => $this->guru->count(),
                "waliKelas" => $this->waliKelas->count(),
                "pelajaran" => $this->pelajaran->count()
            ];

            return view("modules.pages.dashboard", $data);
        } else if (Auth::user()->akses == "GURU") {
            return view("modules.pages.guru.dashboard");
        } else if (Auth::user()->akses == "WAKEL") {
            return view("modules.pages.wakel.dashboard");
        } else if (Auth::user()->akses == "ORTU") {
            return view("modules.pages.wali.dashboard");
        }
    }
}

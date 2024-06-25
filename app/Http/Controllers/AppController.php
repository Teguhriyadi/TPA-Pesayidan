<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Pelajaran;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    protected $siswa, $guru, $waliKelas, $pelajaran, $nilai;

    public function __construct()
    {
        $this->siswa = new Siswa();
        $this->guru = new Guru();
        $this->waliKelas =new WaliKelas();
        $this->pelajaran = new Pelajaran();
        $this->nilai = new Nilai();
    }

    public function dashboard()
    {
        if (Auth::user()->akses == "ADMIN") {

            $data = [
                "siswa" => $this->siswa->where("aktif", "1")->count(),
                "guru" => $this->guru->count(),
                "waliKelas" => $this->waliKelas->count(),
                "pelajaran" => $this->pelajaran->count(),
                "grafikSiswa" => $this->siswa->select(DB::raw("YEAR(tanggalDaftar) as tahun"), DB::raw("COUNT(*) AS jumlah"))->groupBy("tahun")->get()
            ];

            return view("modules.pages.dashboard", $data);
        } else if (Auth::user()->akses == "GURU") {

            $data = [
                "nilai" => $this->nilai->select("siswa_id", DB::raw("SUM(nilai) AS total_nilai"))->groupBy("siswa_id")->orderBy("total_nilai", "DESC")->take(5)->get()
            ];

            foreach ($data["nilai"] as $item) {
                $siswa = Siswa::find($item->siswa_id);
                $item->nama_siswa = $siswa->nama;
            }

            return view("modules.pages.guru.dashboard", $data);
        } else if (Auth::user()->akses == "WAKEL") {
            return view("modules.pages.wakel.dashboard");
        } else if (Auth::user()->akses == "ORTU") {
            return view("modules.pages.wali.dashboard");
        }
    }
}

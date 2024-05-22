<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataSiswaWakelController extends Controller
{
    protected $siswa, $guru, $walikelas;

    public function __construct()
    {
        $this->siswa = new Siswa();
        $this->guru = new Guru();
        $this->walikelas = new WaliKelas();
    }

    public function index()
    {
        try {

            $guru = $this->guru->where("id", Auth::user()->guruId)->first();

            $waliKelas = $this->walikelas->where("guru_id", $guru->id)->where("status", "1")->first();

            DB::beginTransaction();

            $data = [
                "siswa" => $this->siswa->where("kelasId", $waliKelas->kelas_id)->get()
            ];

            DB::commit();

            return view("modules.pages.wakel.data-siswa.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

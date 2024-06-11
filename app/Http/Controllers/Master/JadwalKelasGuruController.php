<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\JadwalKelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JadwalKelasGuruController extends Controller
{
    protected $jadwalKelas, $siswa;

    public function __construct()
    {
        $this->jadwalKelas = new JadwalKelas();
        $this->siswa = new Siswa();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "jadwalKelasSaya" => $this->jadwalKelas->where("guruId", Auth::user()->hasGuru->id)->get(),
                "count" => $this->jadwalKelas->where("guruId", Auth::user()->hasGuru->id)->count()
            ];

            DB::commit();

            return view("modules.pages.master.jadwal-kelas-guru.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function show($id)
    {
        try {

            DB::beginTransaction();

            $data["detail"] = $this->jadwalKelas->where("id", $id)->first();
            $data["siswa"] = $this->siswa->where("kelasId", $data["detail"]["kelasPelajaran"]["kelas"]["id"])->get();

            DB::commit();

            return view("modules.pages.master.jadwal-kelas-guru.siswa.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

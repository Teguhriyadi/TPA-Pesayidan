<?php

namespace App\Http\Controllers\Penilaian;

use App\Http\Controllers\Controller;
use App\Models\HafalanUjian;
use App\Models\KelompokPenilaian;
use App\Models\Pelajaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HafalanUjianController extends Controller
{
    protected $siswa, $kelompokPenilaian, $pelajaran, $hafalanUjian, $tahunAjaran;

    public function __construct()
    {
        $this->siswa = new Siswa();
        $this->kelompokPenilaian = new KelompokPenilaian();
        $this->pelajaran = new Pelajaran();
        $this->hafalanUjian = new HafalanUjian();
        $this->tahunAjaran = new TahunAjaran();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "siswa" => $this->siswa->get(),
                "kelompokPenilaian" => $this->kelompokPenilaian->get(),
                "hafalanUjian" => $this->hafalanUjian->get()
            ];

            DB::commit();

            return view("modules.pages.penilaian.ujian.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $tahunAjaranId = $this->tahunAjaran->where("status", "1")->first();

            $this->hafalanUjian->create([
                "kelompokPenilaianId" => $request->pilihan,
                "materiId" => $request->pelajaranId,
                "tanggal" => date("Y-m-d H:i:s"),
                "siswaId" => $request->siswaId,
                "guruId" => Auth::user()->hasGuru->id,
                "penilaian" => $request->penilaian,
                "keterangan" => $request->keterangan,
                "tahunAjaranId" => $tahunAjaranId->id
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {

            DB::beginTransaction();

            $pelajaran = $this->pelajaran::where("kelompokPenilaianId", $request["pilihan"])->get();

            DB::commit();

            return response()->json([
                "success" => true,
                "data" => $pelajaran
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "success" => false,
                "data" => $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "edit" => $this->hafalanUjian->where("id", $id)->first(),
                "siswa" => $this->siswa->get(),
                "kelompokPenilaian" => $this->kelompokPenilaian->get()
            ];

            DB::commit();

            return view("modules.pages.penilaian.ujian.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "success" => false,
                "data" => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "detail" => $this->hafalanUjian->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.penilaian.ujian.detail", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

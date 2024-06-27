<?php

namespace App\Http\Controllers\Penilaian;

use App\Http\Controllers\Controller;
use App\Models\AmbilNilai;
use App\Models\HafalanHarian;
use App\Models\KelompokPenilaian;
use App\Models\Pelajaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AmbilNilaiController extends Controller
{
    protected $ambilNilai, $siswa, $kelompokPenilaian, $pelajaran, $hafalan, $tahunAjaran;

    public function __construct()
    {
        $this->ambilNilai = new AmbilNilai();
        $this->siswa = new Siswa();
        $this->kelompokPenilaian = new KelompokPenilaian();
        $this->pelajaran = new Pelajaran();
        $this->hafalan = new HafalanHarian();
        $this->tahunAjaran = new TahunAjaran();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $ambilNilai = $this->ambilNilai->orderBy("id", "ASC")->get();
            $data = [];

            foreach ($ambilNilai as $nilai) {
                $siswaId = $nilai->siswa_id;

                if (!isset($data[$siswaId])) {
                    $data[$siswaId] = $nilai;
                }
            }

            DB::commit();

            return view("modules.pages.penilaian.ambil-nilai.index", ["ambilNilai" => $data]);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function create()
    {
        try {

            DB::beginTransaction();

            $data["siswa"] = $this->siswa->where("aktif", "1")->get();

            $data["kelompokPenilaian"] = $this->kelompokPenilaian->get();

            foreach ($data["kelompokPenilaian"] as $kelompokPenilaian) {
                $kelompokPenilaian->pelajaran = $this->pelajaran->where("kelompokPenilaianId", $kelompokPenilaian->id)
                    ->get();
            }

            DB::commit();

            return view("modules.pages.penilaian.ambil-nilai.create", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {

            DB::beginTransaction();

            $siswa = $request->input("siswa");
            $kelompokPenilaian = $request->input("kelompokPenilaian");

            $hafalan = $this->hafalan->where("kelompokPenilaianId", $kelompokPenilaian)
                    ->where("siswaId", $siswa)
                    ->with("materi")
                    ->get();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Berhasil di Tampilkan",
                "data" => $hafalan
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $tahunAjaranId = $this->tahunAjaran->where("status", "1")->first();

            foreach ($request->pelajaranId as $pelajaranId) {
                $this->ambilNilai->create([
                    "kelompok_penilaian_id" => $request->penilaianKelompok,
                    "siswa_id" => $request->siswaId,
                    "guru_id" => Auth::user()->hasGuru->id,
                    "hafalan_id" => $pelajaranId,
                    "tahun_ajaran_id" => $tahunAjaranId->id
                ]);
            }

            DB::commit();

            return redirect()->route("modules.penilaian.ambil-nilai.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function show($id, $kelompokPenilaianId)
    {
        try {

            DB::beginTransaction();

            $ambilNilai = $this->ambilNilai->orderBy("id", "ASC")->get();
            $data = [];

            foreach ($ambilNilai as $nilai) {
                $siswaId = $nilai->siswa_id;

                if (!isset($data[$siswaId])) {
                    $data[$siswaId] = $nilai;
                }
            }

            DB::commit();

            return view("modules.pages.penilaian.ambil-nilai.index", ["ambilNilai" => $data]);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Penilaian;

use App\Http\Controllers\Controller;
use App\Models\HafalanHarian;
use App\Models\KelompokPenilaian;
use App\Models\Pelajaran;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HafalanHarianController extends Controller
{
    protected $materi, $siswa, $hafalanHarian, $tahunAjaran, $kelompokPenilaian;

    public function __construct()
    {
        $this->materi = new Pelajaran();
        $this->siswa = new Siswa();
        $this->hafalanHarian = new HafalanHarian();
        $this->tahunAjaran = new TahunAjaran();
        $this->kelompokPenilaian = new KelompokPenilaian();
    }

    public function index(Request $request)
    {
        try {

            DB::beginTransaction();

            $segments = $request->segments();

            $lastSegment = end($segments);

            $data = [
                "materi" => $this->materi->get(),
                "siswa" => $this->siswa->get(),
                "kelompokPenilaian" => $this->kelompokPenilaian->get(),
                "kategori" => $lastSegment
            ];

            if ($lastSegment == "harian") {
                $data["hafalanHarian"] = $this->hafalanHarian->where("guruId", Auth::user()->hasGuru->id)->where("kategori", "HAFALAN")->orderBy("tanggal", "DESC")->get();
            } else if ($lastSegment == "ujian") {
                $data["hafalanHarian"] = $this->hafalanHarian->where("guruId", Auth::user()->hasGuru->id)->where("kategori", "UJIAN")->orderBy("tanggal", "DESC")->get();
            }

            DB::commit();

            return view("modules.pages.penilaian.harian.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $segments = $request->segments();

            $tahunAjaran = $this->tahunAjaran->where("status", "1")->first();

            if ($request->materiId) {
                $cekId = $this->materi->where("id", $request->materiId)->first();
            } else {
                $cekPilihan = $this->kelompokPenilaian->where("slug", $request->pilihan)->first();
            }

            $this->hafalanHarian->create([
                "kelompokPenilaianId" => $request->materiId ? $cekId->id : $cekPilihan->id,
                "materiId" => $request->materiId ? $request->materiId : null,
                "jilidSurat" => $request->jilidSurat ? $request->jilidSurat : null,
                "dari" => $request->pilihan == "tahfidz-juz-amma" || $request->pilihan == "surat-pilihan" || $request->pilihan == "iqro-jilid" ? $request->dari : null,
                "sampai" => $request->pilihan == "tahfidz-juz-amma" || $request->pilihan == "surat-pilihan" || $request->pilihan == "iqro-jilid" ? $request->sampai : null,
                "tanggal" => date("Y-m-d H:i:s"),
                "siswaId" => $request->siswaId,
                "guruId" => Auth::user()->hasGuru->id,
                "penilaian" => $request->penilaian,
                "tahunAjaranId" => $tahunAjaran->id,
                "keterangan" => $request->keterangan,
                "kategori" => $segments[2] == "harian" ? "HAFALAN" : "UJIAN"
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function edit($kategori, $id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "materi" => $this->materi->get(),
                "siswa" => $this->siswa->get(),
                "edit" => $this->hafalanHarian->where("id", $id)->first(),
                "kelompokPenilaian" => $this->kelompokPenilaian->get(),
                "kategori" => $kategori
            ];

            DB::commit();

            return view("modules.pages.penilaian.harian.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function search(Request $request)
    {
        try {

            DB::beginTransaction();

            $cek = $this->kelompokPenilaian->where("slug", $request->pilihan)->first();

            $getMateri = $this->materi->where("kelompokPenilaianId", $cek->id)->get();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Get Data Success",
                "data" => $getMateri
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $kategori, $id)
    {
        try {

            DB::beginTransaction();

            $hafalanHarian = $this->hafalanHarian->where("id", $id)->first();

            $hafalanHarian->update([
                "materiId" => $request->materiId ? $request->materiId : null,
                "jilidSurat" => $request->jilidSurat ? $request->jilidSurat : null,
                "halAyat" => $request->halAyat ? $request->halAyat : null,
                "siswaId" => $request->siswaId,
                "penilaian" => $request->penilaian,
                "keterangan" => $request->keterangan,
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

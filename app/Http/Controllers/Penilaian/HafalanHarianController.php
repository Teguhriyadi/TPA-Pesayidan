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

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "materi" => $this->materi->get(),
                "siswa" => $this->siswa->get(),
                "hafalanHarian" => $this->hafalanHarian->where("guruId", Auth::user()->hasGuru->id)->get(),
                "kelompokPenilaian" => $this->kelompokPenilaian->where("kategori", "Ujian")->get()
            ];

            DB::commit();

            return view("modules.pages.penilaian.harian.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $tahunAjaran = $this->tahunAjaran->where("status", "1")->first();

            $this->hafalanHarian->create([
                "materiId" => $request->materiId ? $request->materiId : null,
                "jilidSurat" => $request->jilidSurat ? $request->jilidSurat : null,
                "halAyat" => $request->halAyat ? $request->halAyat : null,
                "tanggal" => date("Y-m-d H:i:s"),
                "siswaId" => $request->siswaId,
                "guruId" => Auth::user()->hasGuru->id,
                "penilaian" => $request->penilaian,
                "tahunAjaranId" => $tahunAjaran->id
            ]);

            DB::commit();

            return redirect()->route("modules.penilaian.harian.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "materi" => $this->materi->get(),
                "siswa" => $this->siswa->get(),
                "edit" => $this->hafalanHarian->where("id", $id)->first(),
                "kelompokPenilaian" => $this->kelompokPenilaian->where("kategori", "Ujian")->get()
            ];

            DB::commit();

            return view("modules.pages.penilaian.harian.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

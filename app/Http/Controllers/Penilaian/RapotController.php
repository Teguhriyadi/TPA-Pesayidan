<?php

namespace App\Http\Controllers\Penilaian;

use App\Helpers\NumberToTextHelper;
use App\Http\Controllers\Controller;
use App\Models\AspekPenilaian;
use App\Models\KelompokRapot;
use App\Models\Rapot;
use App\Models\RapotDetail;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RapotController extends Controller
{
    protected $siswa, $tahunAjaran, $kelompokRapot, $rapot, $rapotDetail, $aspekPenilaian;

    public function __construct()
    {
        $this->siswa = new Siswa();
        $this->tahunAjaran = new TahunAjaran();
        $this->kelompokRapot = new KelompokRapot();
        $this->rapot = new Rapot();
        $this->rapotDetail = new RapotDetail();
        $this->aspekPenilaian = new AspekPenilaian();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "rapot" => $this->rapot->where("guru_id", Auth::user()->id)->get()
            ];

            DB::commit();

            return view("modules.pages.penilaian.rapot.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function create()
    {
        try {

            DB::beginTransaction();

            $data = [
                "siswa" => $this->siswa->where("kelasId", Auth::user()->hasWakel->kelas_id)->where("aktif", "1")->get(),
                "kelompokRapot" => $this->kelompokRapot->get()
            ];

            DB::commit();

            return view("modules.pages.penilaian.rapot.create", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $kelompokRapot = $this->kelompokRapot->get();

            $tahunAjaran = $this->tahunAjaran->where("status", "1")->first();

            $searchKelasIdSiswa = $this->siswa->where("id", $request->siswaId)->first();

            $rapot = $this->rapot->create([
                "tahun_ajaran_id" => $tahunAjaran->id,
                "guru_id" => Auth::user()->id,
                "siswa_id" => $request->siswaId,
                "kelas_id" => $searchKelasIdSiswa->kelasId
            ]);

            foreach ($kelompokRapot as $index => $item) {
                $this->rapotDetail->create([
                    "rapot_id" => $rapot->id,
                    "kelompok_rapot_id" => $item->id,
                    "nilai" => $request->nilai[$index]
                ]);
            }

            $this->aspekPenilaian->create([
                "rapot_id" => $rapot->id,
                "sikap" => $request->sikap,
                "kerajinan" => $request->kerajinan,
                "kebersihan" => $request->kebersihan,
                "kerapihan" => $request->kerapihan,
                "eskul" => $request->eskul,
            ]);

            DB::commit();

            return redirect()->route("modules.penilaian.rapot.index")->with("success", "Data Berhasil di Simpan");

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
                "siswa" => $this->siswa->where("kelasId", Auth::user()->hasWakel->kelas_id)->where("aktif", "1")->get(),
                "kelompokRapot" => $this->kelompokRapot->get(),
                "edit" => $this->rapot->where("id", $id)->first(),
            ];

            $data["editKelompokRapot"] = $this->rapotDetail->where("rapot_id", $id)->get();
            $data["editAspek"] = $this->aspekPenilaian->where("rapot_id", $data["edit"]->id)->first();

            DB::commit();

            return view("modules.pages.penilaian.rapot.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $idRapot)
    {
        try {

            DB::beginTransaction();

            $rapot = $this->rapot->where("id", $idRapot)->first();

            $rapot->update([
                "siswa_id" => $request->siswaId
            ]);

            $rapotDetail = $this->rapotDetail->where("rapot_id", $rapot->id)->get();

            foreach ($rapotDetail as $index => $item) {
                $item->update([
                    "nilai" => $request->nilai[$index]
                ]);
            }

            $aspekPenilaian = $this->aspekPenilaian->where("rapot_id", $rapot->id)->first();

            $aspekPenilaian->update([
                "sikap" => $request->sikap,
                "kerajinan" => $request->kerajinan,
                "kebersihan" => $request->kebersihan,
                "kerapihan" => $request->kerapihan,
                "eskul" => $request->eskul,
            ]);

            DB::commit();

            return redirect()->route("modules.penilaian.rapot.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function show($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "edit" => $this->rapot->where("id", $id)->first(),
            ];

            $data["rapotDetail"] = $this->rapotDetail->where("rapot_id", $id)->get();
            $data["editAspek"] = $this->aspekPenilaian->where("rapot_id", $data["edit"]->id)->first();

            foreach ($data["rapotDetail"] as $item) {
                $item->nilai_teks = NumberToTextHelper::convert($item->nilai);
            }
            DB::commit();

            return view("modules.pages.penilaian.rapot.show", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

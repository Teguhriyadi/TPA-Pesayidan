<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\JadwalKelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JadwalKelasGuruController extends Controller
{
    protected $jadwalKelas, $siswa, $nilai, $tahunAjaran;

    public function __construct()
    {
        $this->jadwalKelas = new JadwalKelas();
        $this->siswa = new Siswa();
        $this->nilai = new Nilai();
        $this->tahunAjaran = new TahunAjaran();
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

            foreach ($data["siswa"] as $siswa) {
                $siswa->jumlah_pertemuan = $this->nilai->where("siswa_id", $siswa->id)->where("jadwal_id", $id)->count();
            }

            $data["id"] = $id;

            DB::commit();

            return view("modules.pages.master.jadwal-kelas-guru.siswa.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function getForm($idJadwal, $idSiswa)
    {
        try {

            DB::beginTransaction();

            $pertemuan = $this->nilai->where("siswa_id", $idSiswa)
                        ->where("jadwal_id",$idJadwal)
                        ->orderBy("id", "DESC")
                        ->first();

            $data = [
                "id_jadwal" => $idJadwal,
                "id_siswa" => $idSiswa,
                "pertemuan" => empty($pertemuan) ? 1 : $pertemuan->pertemuan + 1
            ];

            DB::commit();

            return view("modules.pages.master.jadwal-kelas-guru.siswa.nilai", $data);

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

            $tahunAjaran = $this->tahunAjaran->where("status", "1")->first();

            $this->nilai->create([
                "guru_id" => Auth::user()->hasGuru->id,
                "jadwal_id" => $request->id_jadwal,
                "siswa_id" => $request->id_siswa,
                "nilai" => $request->nilai,
                "pertemuan" => $request->pertemuan,
                "tahun_ajaran_id" => $tahunAjaran->id,
                "tanggal" => date("Y-m-d H:i:s")
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function detailNilai($idJadwal, $idSiswa)
    {
        try {

            DB::beginTransaction();

            $data = [
                "siswa" => $this->siswa->where("id", $idSiswa)->first(),
                "nilai" => $this->nilai->where("jadwal_id", $idJadwal)->where("siswa_id", $idSiswa)->get(),
                "jadwalId" => $idJadwal,
                "siswaId" => $idSiswa
            ];

            DB::commit();

            return view("modules.pages.master.jadwal-kelas-guru.siswa.detail", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route('modules.master.jadwal-kelas-guru.index')->with("error", $e->getMessage());
        }
    }

    public function edit($idJadwal, $idSiswa, $nilaId)
    {
        try {

            DB::beginTransaction();

            $data = [
                "jadwalId" => $idJadwal,
                "siswaId" => $idSiswa,
                "edit" => $this->nilai->where("id", $nilaId)->first()
            ];

            DB::commit();

            return view("modules.pages.master.jadwal-kelas-guru.siswa.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $jadwalId, $siswaId, $nilaiId)
    {
        try {

            DB::beginTransaction();

            $this->nilai->where("id", $nilaiId)->update([
                "nilai" => $request->nilai
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

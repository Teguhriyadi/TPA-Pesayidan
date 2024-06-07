<?php

namespace App\Http\Controllers\Pembelajaran;

use App\Http\Controllers\Controller;
use App\Models\Pelajaran;
use App\Models\PenilaianHafalan;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HafalanQuranController extends Controller
{
    protected $siswa, $pelajaran, $penilaianHafalan, $tahunAjaran;

    public function __construct()
    {
        $this->siswa = new Siswa();
        $this->pelajaran = new Pelajaran();
        $this->penilaianHafalan = new PenilaianHafalan();
        $this->tahunAjaran = new TahunAjaran();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "siswa" => $this->siswa->where("aktif", "1")->get(),
                "pelajaran" => $this->pelajaran->where("kategori", "Hafalan")->get(),
                "penilaianHafalan" => $this->penilaianHafalan->get()
            ];

            DB::commit();

            return view("modules.pages.pembelajaran.hafalan.index", $data);

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

            $this->penilaianHafalan->create([
                "pelajaranId" => $request->pelajaranId,
                "siswaId" => $request->siswaId,
                "rating" => $request->rating,
                "guruId" => Auth::user()->hasGuru->id,
                "keterangan" => $request->keterangan ? $request->keterangan : "",
                "tahunAjaranId" => $tahunAjaran->id
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

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
                "siswa" => $this->siswa->where("aktif", "1")->get(),
                "pelajaran" => $this->pelajaran->where("kategori", "Hafalan")->get(),
                "edit" => $this->penilaianHafalan->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.pembelajaran.hafalan.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->penilaianHafalan->where("id", $id)->update([
                "pelajaranId" => $request->pelajaranId,
                "siswaId" => $request->siswaId,
                "rating" => $request->rating,
                "keterangan" => $request->keterangan
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $this->penilaianHafalan->where("id", $id)->delete();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Berhasil di Hapus"
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.pembelajaran.hafalan.index")->with("error", $e->getMessage());
        }
    }
}

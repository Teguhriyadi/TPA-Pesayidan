<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KelasPelajaran;
use App\Models\Pelajaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasPelajaranController extends Controller
{
    protected $kelasPelajaran, $pelajaran, $kelas, $tahunAjaran;

    public function __construct()
    {
        $this->kelasPelajaran = new KelasPelajaran();
        $this->pelajaran = new Pelajaran();
        $this->kelas = new Kelas();
        $this->tahunAjaran = new TahunAjaran();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "pelajaran" => $this->pelajaran->where("kategori", "Pelajaran")->get(),
                "kelas" => $this->kelas->get(),
                "kelasPelajaran" => $this->kelasPelajaran->get()
            ];

            DB::commit();

            return view("modules.pages.master.kelasPelajaran.index", $data);

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

            $this->kelasPelajaran->create([
                "tahun_ajaran_id" => $tahunAjaran->id,
                "pelajaran_id" => $request->pelajaran_id,
                "kelas_id" => $request->kelas_id
            ]);

            DB::commit();

            return redirect()->route("modules.master.kelas-pelajaran.index")->with("success", "Data Berhasil di Simpan");

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
                "pelajaran" => $this->pelajaran->where("kategori", "Pelajaran")->get(),
                "kelas" => $this->kelas->get(),
                "edit" => $this->kelasPelajaran->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.master.kelasPelajaran.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->kelasPelajaran->where("id", $id)->update([
                "pelajaran_id" => $request->pelajaran_id,
                "kelas_id" => $request->kelas_id
            ]);

            DB::commit();

            return redirect()->route("modules.master.kelas-pelajaran.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $this->kelasPelajaran->where("id", $id)->delete();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Berhasil di Hapus"
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}

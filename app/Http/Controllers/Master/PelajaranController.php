<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\KelompokPenilaian;
use App\Models\Pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelajaranController extends Controller
{
    protected $pelajaran, $kelompokPenilaian;

    public function __construct()
    {
        $this->pelajaran = new Pelajaran();
        $this->kelompokPenilaian = new KelompokPenilaian();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "pelajaran" => $this->pelajaran->orderBy("id", "DESC")->get(),
                "kelompokPenilaian" => $this->kelompokPenilaian->get()
            ];

            DB::commit();

            return view("modules.pages.master.pelajaran.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->pelajaran->create([
                "kode" => "PL-" . time(),
                "nama" => $request->nama,
                "kelompokPenilaianId" => $request->kelompokPenilaianId
            ]);

            DB::commit();

            return redirect()->route("modules.master.pelajaran.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.pelajaran.index")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "edit" => $this->pelajaran->where("id", $id)->first(),
                "kelompokPenilaian" => $this->kelompokPenilaian->get()
            ];

            DB::commit();

            return view("modules.pages.master.pelajaran.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->pelajaran->where("id", $id)->update([
                "nama" => $request->nama,
                "kelompokPenilaianId" => $request->kelompokPenilaianId
            ]);

            DB::commit();

            return redirect()->route("modules.master.pelajaran.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $this->pelajaran->where("id", $id)->delete();

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

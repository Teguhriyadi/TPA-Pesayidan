<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Pelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HafalanController extends Controller
{
    protected $hafalan;

    public function __construct()
    {
        $this->hafalan = new Pelajaran();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "hafalan" => $this->hafalan->where("kategori", "Hafalan")->get()
            ];

            DB::commit();

            return view("modules.pages.master.hafalan.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->hafalan->create([
                "kode" => "HFLN-" . time(),
                "nama" => $request->nama,
                "kategori" => "Hafalan"
            ]);

            DB::commit();

            return redirect()->route("modules.master.hafalan.index")->with("success", "Data Berhasil di Simpan");

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
                "edit" => $this->hafalan->where("id", $id)->first()
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

            $this->hafalan->where("id", $id)->update([
                "nama" => $request->nama
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

            $this->hafalan->where("id", $id)->delete();

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

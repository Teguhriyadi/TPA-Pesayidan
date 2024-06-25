<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\KelompokRapot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelompokRapotController extends Controller
{
    protected $kelompokRapot, $kategori;

    public function __construct()
    {
        $this->kelompokRapot = new KelompokRapot();
        $this->kategori = new Kategori();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "kelompokRapot" => $this->kelompokRapot->orderBy("id", "DESC")->get(),
                "kategori" => $this->kategori->get()
            ];

            DB::commit();

            return view("modules.pages.master.kelompok-rapot.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->kelompokRapot->create($request->all());

            DB::commit();

            return redirect()->route("modules.master.kelompok-rapot.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.kelompok-rapot.index")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "edit" => $this->kelompokRapot->where("id", $id)->first(),
                "kategori" => $this->kategori->get()
            ];

            DB::commit();

            return view("modules.pages.master.kelompok-rapot.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.kelompokRapot")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->kelompokRapot->where("id", $id)->update([
                "nama_kelompok_rapot" => $request->nama_kelompok_rapot,
                "kategoriId" => $request->kategoriId
            ]);

            DB::commit();

            return redirect()->route("modules.master.kelompok-rapot.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.kelompok-rapot.index")->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $this->kelompokRapot->where("id", $id)->delete();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Berhasil di Hapus"
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.admin.index")->with("error", $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new Kategori();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "kategori" => $this->kategori->orderBy("id", "DESC")->get()
            ];

            DB::commit();

            return view("modules.pages.master.kategori.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->kategori->create($request->all());

            DB::commit();

            return redirect()->route("modules.master.kategori.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.kategori.index")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "edit" => $this->kategori->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.master.kategori.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.kategori")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->kategori->where("id", $id)->update([
                "nama_kategori" => $request->nama_kategori,
            ]);

            DB::commit();

            return redirect()->route("modules.master.kategori.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.kategori.index")->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $this->kategori->where("id", $id)->delete();

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

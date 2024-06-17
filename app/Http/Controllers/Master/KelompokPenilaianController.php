<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\KelompokPenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KelompokPenilaianController extends Controller
{
    protected $kelompokPenilaian;

    public function __construct()
    {
        $this->kelompokPenilaian = new KelompokPenilaian();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "kelompokPenilaian" => $this->kelompokPenilaian->orderBy("id", "DESC")->get()
            ];

            DB::commit();

            return view("modules.pages.master.kelompok-penilaian.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->kelompokPenilaian->create([
                "kelompok" => $request->kelompok,
                "slug" => Str::slug($request->kelompok),
                "kategori" => $request->kategori
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
                "edit" => $this->kelompokPenilaian->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.master.kelompok-penilaian.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->kelompokPenilaian->where("id", $id)->update([
                "kelompok" => $request->kelompok,
                "slug" => Str::slug($request->kelompok),
                "kategori" => $request->kategori
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

            $this->kelompokPenilaian->where("id", $id)->delete();

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

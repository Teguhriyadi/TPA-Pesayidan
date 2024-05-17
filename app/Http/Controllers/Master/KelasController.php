<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    protected $kelas;

    public function __construct()
    {
        $this->kelas = new Kelas();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "kelas" => $this->kelas->orderBy("id", "DESC")->get()
            ];

            DB::commit();

            return view("modules.pages.master.kelas.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            $cekCountData = $this->kelas->where("jenjang", "TK")->count();

            if ($cekCountData) {

                if ($request->jenjang == "TK") {
                    return back()->with("error", "Jenjang TK Hanya Bisa 1 Kelas")->withInput();
                } else {
                    $this->kelas->create($request->all());

                    return redirect()->route("modules.master.kelas")->with("success", "Data Berhasil di Simpan");
                }
            } else {
                $this->kelas->create($request->all());

                return redirect()->route("modules.master.kelas")->with("success", "Data Berhasil di Simpan");
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.kelas")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "edit" => $this->kelas->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.master.kelas.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.admin.index")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->kelas->where("id", $id)->update([
                "namaKelas" => $request->namaKelas,
                "deskripsi" => $request->deskripsi
            ]);

            DB::commit();

            return redirect()->route("modules.master.kelas")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.kelas")->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $this->kelas->where("id", $id)->delete();

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

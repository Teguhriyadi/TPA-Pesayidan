<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAjaranController extends Controller
{
    protected $tahun_ajaran;

    public function __construct()
    {
        $this->tahun_ajaran = new TahunAjaran();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "tahun_ajaran" => $this->tahun_ajaran->orderBy("status", "ASC")->get()
            ];

            DB::commit();

            return view("modules.pages.master.tahun_ajaran.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $cek = $this->tahun_ajaran->count();

            if ($cek == 0) {
                $this->tahun_ajaran->create([
                    "tahun_ajaran" => $request->tahun_ajaran,
                    "status" => '1'
                ]);
            } else {
                $this->tahun_ajaran->create([
                    "tahun_ajaran" => $request->tahun_ajaran,
                    "status" => '0'
                ]);
            }


            DB::commit();

            return redirect()->route("modules.master.tahun_ajaran")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.tahun_ajaran")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "edit" => $this->tahun_ajaran->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.master.tahun_ajaran.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.admin.index")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->tahun_ajaran->where("id", $id)->update([
                "tahun_ajaran" => $request->tahun_ajaran
            ]);

            DB::commit();

            return redirect()->route("modules.master.tahun_ajaran")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.tahun_ajaran")->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $cekCountData = $this->tahun_ajaran->count();

            if ($cekCountData == 2 || $cekCountData > 2 ) {

                $cekData = $this->tahun_ajaran->where("id", $id)->first();

                if ($cekData->status == "1") {

                    if ($cekCountData > 2) {
                        $cekData->delete();
                    } else {
                        $this->tahun_ajaran->where("status", "0")->update([
                            "status" => "1"
                        ]);

                        $cekData->delete();
                    }
                } else if ($cekData->status == "0") {
                    $cekData->delete();
                }
            } else if ($cekCountData == 1) {
                return response()->json([
                    "status" => true,
                    "code" => 1,
                    "message" => "Maaf, Harus Ada Minimal 2 Data Agar Bisa Mengubah Status"
                ], 200);
            }

            $this->tahun_ajaran->where("id", $id)->delete();

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.admin.index")->with("error", $e->getMessage());
        }
    }

    public function change($id)
    {
        try {

            $cek = $this->tahun_ajaran->count();

            if ($cek == 1) {
                return response()->json([
                    "status" => true,
                    "code" => 1,
                    "message" => "Maaf, Harus Ada Minimal 2 Data Agar Bisa Mengubah Status"
                ], 200);
            } else {
                $cekData = $this->tahun_ajaran->where("id", $id)->first();

                if ($cekData->status == "0") {

                    $cekActiveData = $this->tahun_ajaran->where("status", "1")->first();

                    if (!$cekActiveData) {
                        $cekData->update([
                            "status" => "1"
                        ]);
                    } else {
                        $this->tahun_ajaran->where("status", 1)->update([
                            "status" => "0"
                        ]);

                        $cekData->update([
                            "status" => "1"
                        ]);
                    }

                } else if ($cekData->status == "1") {

                    $cekCountTwoData = $this->tahun_ajaran->count();

                    if ($cekCountTwoData == 2) {
                        $this->tahun_ajaran->where("status", "0")->update([
                            "status" => "1"
                        ]);

                        $cekData->update([
                            "status" => "0"
                        ]);
                    } else {
                        $cekData->update([
                            "status" => "0"
                        ]);
                    }
                }
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.tahun_ajaran")->with("error", $e->getMessage());
        }
    }
}

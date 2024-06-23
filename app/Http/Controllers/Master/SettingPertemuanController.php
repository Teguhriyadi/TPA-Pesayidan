<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\SettingPertemuan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingPertemuanController extends Controller
{
    protected $settingPertemuan, $tahunAjaran;

    public function __construct()
    {
        $this->settingPertemuan = new SettingPertemuan();
        $this->tahunAjaran = new TahunAjaran();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "settingPertemuan" => $this->settingPertemuan->orderBy("status", "ASC")->get()
            ];

            DB::commit();

            return view("modules.pages.master.setting-pertemuan.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $cek = $this->settingPertemuan->count();
            $tahunAjaran = $this->tahunAjaran->where("status", "1")->first();

            if ($cek == 0) {
                $this->settingPertemuan->create([
                    "tahunAjaranId" => $tahunAjaran->id,
                    "jumlah" => $request->jumlah,
                    "status" => '1'
                ]);
            } else {
                $this->settingPertemuan->create([
                    "tahunAjaranId" => $tahunAjaran->id,
                    "jumlah" => $request->jumlah,
                    "status" => '0'
                ]);
            }

            DB::commit();

            return redirect()->route("modules.setting-pertemuan.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "edit" => $this->settingPertemuan->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.master.setting-pertemuan.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.admin.index")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->settingPertemuan->where("id", $id)->update([
                "jumlah" => $request->jumlah
            ]);

            DB::commit();

            return redirect()->route("modules.setting-pertemuan.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $cekCountData = $this->settingPertemuan->count();

            if ($cekCountData == 2 || $cekCountData > 2 ) {

                $cekData = $this->settingPertemuan->where("id", $id)->first();

                if ($cekData->status == "1") {

                    if ($cekCountData > 2) {
                        $cekData->delete();
                    } else {
                        $this->settingPertemuan->where("status", "0")->update([
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

            $this->settingPertemuan->where("id", $id)->delete();

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function change($id)
    {
        try {

            $cek = $this->settingPertemuan->count();

            if ($cek == 1) {
                return response()->json([
                    "status" => true,
                    "code" => 1,
                    "message" => "Maaf, Harus Ada Minimal 2 Data Agar Bisa Mengubah Status"
                ], 200);
            } else {
                $cekData = $this->settingPertemuan->where("id", $id)->first();

                if ($cekData->status == "0") {

                    $cekActiveData = $this->settingPertemuan->where("status", "1")->first();

                    if (!$cekActiveData) {
                        $cekData->update([
                            "status" => "1"
                        ]);
                    } else {
                        $this->settingPertemuan->where("status", 1)->update([
                            "status" => "0"
                        ]);

                        $cekData->update([
                            "status" => "1"
                        ]);
                    }

                } else if ($cekData->status == "1") {

                    $cekCountTwoData = $this->settingPertemuan->count();

                    if ($cekCountTwoData == 2) {
                        $this->settingPertemuan->where("status", "0")->update([
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

            return redirect()->route("modules.master.settingPertemuan")->with("error", $e->getMessage());
        }
    }
}

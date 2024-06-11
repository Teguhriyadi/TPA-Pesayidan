<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrangTuaController extends Controller
{
    protected $orangTua, $siswa;

    public function __construct()
    {
        $this->orangTua = new User();
        $this->siswa = new Siswa();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "orangTua" => $this->orangTua->where("akses", "ORTU")
                    ->withCount("countWali")
                    ->get()
                    ->map(function($user) {
                        $user->nomorHpAktif = $user->activePhoneNumber;
                        return $user;
                    })
            ];

            DB::commit();

            return view("modules.pages.master.orang-tua.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $orangTua = $this->orangTua->where("id", $id)->first();
            if ($orangTua) {
                $orangTua->nomorHpAktif = $orangTua->activePhoneNumber;
            }

            $data = [
                "edit" => $orangTua
            ];

            DB::commit();

            return view("modules.pages.master.orang-tua.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function showAnak($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "anak" => $this->siswa->where("waliId", $id)->get()
            ];

            DB::commit();

            return view("modules.pages.master.orang-tua.show-anak", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->orangTua->where("id", $id)->update([
                "nama" => $request->nama,
                "username" => Str::slug("wali-" . $request->nama),
            ]);

            $this->siswa->where("waliId", $id)->update([
                "nomorHpAktif" => $request->nomorHpAktif
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

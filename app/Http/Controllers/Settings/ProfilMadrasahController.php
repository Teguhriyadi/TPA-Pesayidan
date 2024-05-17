<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\ProfilMadrasah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilMadrasahController extends Controller
{
    protected $profil;

    public function __construct()
    {
        $this->profil = new ProfilMadrasah();
    }

    public function profil()
    {
        try {

            DB::beginTransaction();

            $data = [
                "profil" => $this->profil->first()
            ];

            DB::commit();

            return view("modules.pages.pengaturan.profil.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->profil->create($request->all());

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {

            DB::beginTransaction();

            $profilNow = $this->profil->first();

            $profilNow->update([
                "nama_mdta" => $request->nama_mdta,
                "no_statistik" => $request->no_statistik,
                "provinsi" => $request->provinsi,
                "kabupaten_kota" => $request->kabupaten_kota,
                "kecamatan" => $request->kecamatan,
                "alamat" => $request->alamat
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

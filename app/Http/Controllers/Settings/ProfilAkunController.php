<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfilAkunController extends Controller
{
    protected $profilSaya, $guru;

    public function __construct()
    {
        $this->profilSaya = new User();
        $this->guru = new Guru();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data["profilSaya"] = $this->profilSaya->where("id", Auth::user()->id)->first();

            DB::commit();

            return view("modules.pages.akun.profil-saya.index", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $cek = $this->profilSaya->where("id", $id)->first();

            if ($cek->akses == "GURU") {
                $this->guru->where("userId", $id)->update([
                    "nip" => $request->nip,
                    "jenisKelamin" => $request->jenisKelamin,
                    "tempatLahir" => $request->tempatLahir,
                    "tanggalLahir" => $request->tanggalLahir,
                    "alamat" => $request->alamat
                ]);

                $cek->update([
                    "nama" => $request->nama
                ]);

            } else if ($cek->akses == "ADMIN") {
                if ($request->foto) {
                    if ($request->gambarLama) {
                        Storage::delete($request->gambarLama);
                    }

                    $foto = $request->file("foto")->store("profil-saya");
                } else {
                    $foto = $this->profilSaya->foto;
                }

                $this->profilSaya->where("id", $id)->update([
                    "nama" => $request->nama,
                    "foto" => $foto
                ]);
            }

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function showProfil($id)
    {
        try {

            DB::beginTransaction();

            $data["detail"] = $this->profilSaya->where("id", $id)->first();

            DB::commit();

            return view("modules.pages.akun.profil-saya.show-profil", $data);

        } catch (\Exception $e) {
            return DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function updateImage(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            if ($request->gambarNew) {
                if ($request->gambarLama) {
                    Storage::delete($request->gambarLama);
                }

                $data = $request->file("gambarNew")->store("profil-saya");
            } else {
                $data = $request->gambarLama;
            }

            $this->profilSaya->where("id", $id)->update([
                "foto" => $data
            ]);

            DB::commit();

            return back()->with("success", "Profil Gambar Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

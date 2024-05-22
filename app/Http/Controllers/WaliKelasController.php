<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WaliKelasController extends Controller
{
    protected $waliKelas, $guru, $kelas, $tahun_ajaran, $users;

    public function __construct()
    {
        $this->waliKelas = new WaliKelas();
        $this->guru = new Guru();
        $this->kelas = new Kelas();
        $this->tahun_ajaran = new TahunAjaran();
        $this->users = new User();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "guru" => $this->guru->get(),
                "kelas" => $this->kelas->get(),
                "walikelas" => $this->waliKelas->get()
            ];

            DB::commit();

            return view("modules.pages.master.walikelas.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $tahunAjaranActive = $this->tahun_ajaran->first();

            if (empty($tahunAjaranActive)) {
                return redirect()->route("modules.master.tahun_ajaran")->with("error", "Data Tahun Ajaran Masih Kosong");
            }

            $guru = $this->guru->where("id", $request->guru_id)->first();

            $this->waliKelas->create([
                "guru_id" => $request->guru_id,
                "kelas_id" => $request->kelas_id,
                "tahun_ajaran_id" => $tahunAjaranActive->id
            ]);

            $this->users->create([
                "username" => "wakel-" . Str::slug($guru->users->nama),
                "password" => bcrypt("walikelas"),
                "akses" => "WAKEL",
                "status" => 1,
                "guruId" => $guru->id
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.walikelas.index")->with("error", $e->getMessage());
        }
    }

    public function edit(Request $request, $idWaliKelas)
    {
        try {

            DB::beginTransaction();

            $data = [
                "guru" => $this->guru->get(),
                "kelas" => $this->kelas->get(),
                "edit" => $this->waliKelas->where("id", $idWaliKelas)->first()
            ];

            DB::commit();

            return view("modules.pages.master.walikelas.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.walikelas.index")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $idWaliKelas)
    {
        try {

            DB::beginTransaction();

            $this->waliKelas->where("id", $idWaliKelas)->update([
                "guru_id" => $request->guru_id,
                "kelas_id" => $request->kelas_id
            ]);

            DB::commit();

            return redirect()->route("modules.walikelas.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.walikelas.index")->with("error", $e->getMessage());
        }
    }

    public function destroy($idWaliKelas)
    {
        try {

            DB::beginTransaction();

            $this->waliKelas->where("id", $idWaliKelas)->delete();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Berhasil di Hapus"
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.walikelas.index")->with("error", $e->getMessage());
        }
    }
}

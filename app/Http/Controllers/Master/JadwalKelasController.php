<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\JadwalKelas;
use App\Models\KelasPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JadwalKelasController extends Controller
{
    protected $jadwalKelas, $kelasPelajaran;

    public function __construct()
    {
        $this->jadwalKelas = new JadwalKelas();
        $this->kelasPelajaran = new KelasPelajaran();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "jadwalKelas" => $this->jadwalKelas->get(),
                "kelasPelajaran" => $this->kelasPelajaran->get()
            ];

            DB::commit();

            return view("modules.pages.master.jadwal-kelas.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->jadwalKelas->create([
                "createdId" => Auth::user()->id,
                "kelasPelajaranId" => $request->kelasPelajaranId,
                "hari" => $request->hari,
                "mulai" => $request->mulai,
                "selesai" => $request->selesai
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
                "kelasPelajaran" => $this->kelasPelajaran->get(),
                "edit" => $this->jadwalKelas->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.master.jadwal-kelas.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->jadwalKelas->where("id", $id)->update([
                "kelasPelajaranId" => $request->kelasPelajaranId,
                "hari" => $request->hari,
                "mulai" => $request->mulai,
                "selesai" => $request->selesai
            ]);

            DB::commit();

            return back()->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $this->jadwalKelas->where("id", $id)->delete();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Berhasil di Hapus"
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.master.jadwal-kelas.index")->with("error", $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    protected $siswa;

    public function __construct()
    {
        $this->siswa = new Siswa();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "siswa" => $this->siswa->orderBy("id", "DESC")->get()
            ];

            DB::commit();

            return view("modules.pages.master.siswa.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function create()
    {
        try {

            return view("modules.pages.master.siswa.create");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.guru.index")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->siswa->create([
                "nama" => $request->nama,
                "jenisKelamin" => $request->jenisKelamin,
                "tempatLahir" => $request->tempatLahir,
                "tanggalLahir" => $request->tanggalLahir,
                "namaWali" => $request->namaWali,
                "alamat" => $request->alamat,
                "pendaftarId" => Auth::user()->id
            ]);

            DB::commit();

            return redirect()->route("modules.siswa.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.siswa.index")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "edit" => $this->siswa->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.master.siswa.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.siswa.index")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->siswa->where("id", $id)->update([
                "nama" => $request->nama,
                "jenisKelamin" => $request->jenisKelamin,
                "tempatLahir" => $request->tempatLahir,
                "tanggalLahir" => $request->tanggalLahir,
                "namaWali" => $request->namaWali,
                "alamat" => $request->alamat,
            ]);

            DB::commit();

            return redirect()->route("modules.siswa.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.siswa.index")->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $this->siswa->where("id", $id)->delete();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Berhasil di Hapus"
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.siswa.index")->with("error", $e->getMessage());
        }
    }
}

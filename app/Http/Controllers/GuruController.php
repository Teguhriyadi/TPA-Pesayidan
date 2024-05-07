<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    protected $user, $guru;

    public function __construct()
    {
        $this->user = new User();
        $this->guru = new Guru();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "guru" => $this->guru->orderBy("id", "DESC")->get()
            ];

            DB::commit();

            return view("modules.pages.akun.guru.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function create()
    {
        try {

            return view("modules.pages.akun.guru.create");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.guru.index")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $users = $this->user->create([
                "nama" => $request->nama,
                "username" => $request->username,
                "password" => bcrypt("password123"),
                "akses" => "GURU",
                "status" => 1
            ]);

            $this->guru->create([
                "userId" => $users->id,
                "nip" => $request->nip,
                "jenisKelamin" => $request->jenisKelamin,
                "tempatLahir" => $request->tempatLahir,
                "tanggalLahir" => $request->tanggalLahir,
                "alamat" => $request->alamat,
                "validasiId" => Auth::user()->id
            ]);

            DB::commit();

            return redirect()->route("modules.guru.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.guru.index")->with("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "edit" => $this->guru->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.akun.guru.edit", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.guru.index")->with("error", $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $guru = $this->guru->where("id", $id)->first();

            $guru->update([
                "nip" => $request->nip,
                "jenisKelamin" => $request->jenisKelamin,
                "tempatLahir" => $request->tempatLahir,
                "tanggalLahir" => $request->tanggalLahir,
                "alamat" => $request->alamat,
            ]);

            $this->user->where("id", $guru->userId)->update([
                "nama" => $request->nama,
                "username" => $request->username
            ]);

            DB::commit();

            return redirect()->route("modules.guru.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.guru.index")->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $guru = $this->guru->where("id", $id)->first();

            $this->user->where("id", $guru->userId)->delete();

            $guru->delete();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Berhasil di Hapus"
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.guru.index")->with("error", $e->getMessage());
        }
    }
}

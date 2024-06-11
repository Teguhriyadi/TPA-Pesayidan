<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\SiswaJenjang;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    protected $siswa, $kelas, $siswaJenjang, $tahunAjaran, $user;

    public function __construct()
    {
        $this->siswa = new Siswa();
        $this->kelas = new Kelas();
        $this->siswaJenjang = new SiswaJenjang();
        $this->tahunAjaran = new TahunAjaran();
        $this->user = new User();
    }

    public function index()
    {
        try {

            if (Auth::user()->akses == "ORTU") {

                DB::beginTransaction();

                $data = [
                    "siswa" => $this->siswa->where("waliId", Auth::user()->id)->get()
                ];

                DB::commit();

                return view("modules.pages.wali.siswa.index", $data);
            } else {

                DB::beginTransaction();
                $data = [
                    "siswa" => $this->siswa->orderBy("id", "DESC")->get()
                ];

                DB::commit();

                return view("modules.pages.master.siswa.index", $data);
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function create()
    {
        try {

            $data = [
                "kelas" => $this->kelas->get(),
                "wali" => $this->user->where("akses", "ORTU")->get()
            ];

            return view("modules.pages.master.siswa.create", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.siswa.index")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $dataSiswa = $this->siswa->create([
                "nama" => $request->nama,
                "jenisKelamin" => $request->jenisKelamin,
                "tempatLahir" => $request->tempatLahir,
                "tanggalLahir" => $request->tanggalLahir,
                "alamat" => $request->alamat,
                "pendaftarId" => Auth::user()->id,
                "kelasId" => $request->kelasId
            ]);

            if ($request->option == "Ya") {
                $this->siswa->where("id", $dataSiswa->id)->update([
                    "waliId" => $request->waliId
                ]);
            } else {
                $wali = $this->user->create([
                    "nama" => $request->namaWali,
                    "username" => Str::slug("wali-" . $request->nama),
                    "password" => bcrypt("wali123"),
                    "akses" => "ORTU",
                    "status" => "1"
                ]);

                $this->siswa->where("id", $dataSiswa->id)->update([
                    "waliId" => $wali->id,
                    "nomorHpAktif" => $request->nomorHpAktif
                ]);
            }

            $tahunAjaranActive = $this->tahunAjaran->first();

            $this->siswaJenjang->create([
                "siswaId" => $dataSiswa->id,
                "kelasId" => $request->kelasId,
                "tahunAjaranId" => $tahunAjaranActive->id,
                "status" => 1
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
                "kelas" => $this->kelas->get(),
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

            $siswa = $this->siswa->where("id", $id)->first();

            $siswa->update([
                "nama" => $request->nama,
                "jenisKelamin" => $request->jenisKelamin,
                "tempatLahir" => $request->tempatLahir,
                "tanggalLahir" => $request->tanggalLahir,
                "alamat" => $request->alamat,
                "kelasId" => $request->kelasId
            ]);

            $this->user->where("id", $siswa->waliId)->update([
                "nama" => $request->namaWali,
                "username" => Str::slug("wali-" . $request->namaWali)
            ]);

            DB::commit();

            return redirect()->route("modules.siswa.index")->with("success", "Data Berhasil di Simpan");

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $siswa = $this->siswa->where("id", $id)->first();

            $this->siswaJenjang->where("siswaId", $siswa->id)->delete();

            $this->user->where("id", $siswa->waliId)->delete();

            $siswa->delete();

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

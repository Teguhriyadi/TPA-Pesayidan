<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}

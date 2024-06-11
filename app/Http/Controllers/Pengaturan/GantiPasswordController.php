<?php

namespace App\Http\Controllers\Pengaturan;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GantiPasswordController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            if ($request->passwordBaru != $request->konfirmasiPassword) {
                return back()->with("error", "Konfirmasi Password Tidak Sesuai");
            } else {
                $this->user->where("id", $id)->update([
                    "password" => bcrypt($request->passwordBaru)
                ]);
            }

            DB::commit();

            return back()->with("success", "Password Berhasil di Perbaharui");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        return view("authorization.login");
    }

    public function process(Request $request)
    {
        try {

            $cek = $this->user->where("username", $request->username)->first();

            if ($cek->status == "1") {
                if ($cek) {

                    $cekPassword = Hash::check($request->password, $cek->password);

                    if ($cekPassword) {
                        if (Auth::attempt(["username" => $request->username, "password" => $request->password])) {
                            $request->session()->regenerate();

                            return redirect()->route("modules.dashboard")->with("success", "Anda Berhasil Login");
                        }
                    } else {
                        return redirect()->route("authorization.login")->with("error", "Password Anda Salah")->withInput();
                    }
                } else {
                    return redirect()->route("authorization.login")->with("error", "Data Tidak Ditemukan");
                }
            } else {
                return redirect()->route("authorization.login")->with("error", "Akun Anda Tidak Aktif");
            }

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("authorization.login");
        }
    }

    public function logout()
    {
        try {

            DB::beginTransaction();

            Auth::logout();

            DB::commit();

            return redirect()->route("authorization.login")->with("success", "Anda Berhasil Logout");
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

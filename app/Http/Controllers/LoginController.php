<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view("authorization.login");
    }

    public function process(Request $request)
    {
        try {

            if (Auth::attempt(["username" => $request->username, "password" => $request->password])) {
                $request->session()->regenerate();

                return redirect()->route("modules.dashboard");
            } else {
                // return back();
                echo "error";
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

            return redirect()->route("authorization.login");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("authorization.login");
        }
    }
}

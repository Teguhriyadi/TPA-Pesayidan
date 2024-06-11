<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->akses == "ADMIN") {
            return view("modules.pages.dashboard");
        } else if (Auth::user()->akses == "GURU") {
            return view("modules.pages.guru.dashboard");
        } else if (Auth::user()->akses == "WAKEL") {
            return view("modules.pages.wakel.dashboard");
        } else if (Auth::user()->akses == "ORTU") {
            return view("modules.pages.wali.dashboard");
        }
    }
}

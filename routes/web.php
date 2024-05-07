<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/template", function () {
    return view("modules.layouts.main");
});

Route::group(["middleware" => ["guest"]], function () {
    Route::controller(LoginController::class)->group(function () {
        Route::prefix("login")->group(function () {
            Route::get("/", "index")->name("authorization.login");
            Route::post("/", "process")->name("authorization.process");
        });
    });
});

Route::group(["middleware" => ["autentikasi"]], function () {
    Route::prefix("modules")->group(function () {
        Route::controller(AppController::class)->group(function () {
            Route::get("/dashboard", "dashboard")->name("modules.dashboard");
        });

        Route::controller(AdminController::class)->group(function () {
            Route::prefix("akun-admin")->group(function () {
                Route::get("/", "index")->name("modules.admin.index");
                Route::post("/", "store")->name("modules.admin.store");
                Route::get("/{id}/edit", "edit")->name("modules.admin.edit");
                Route::put("/{id}", "update")->name("modules.admin.update");
                Route::delete("/{id}", "destroy")->name("modules.admin.destroy");
            });
        });

        Route::controller(GuruController::class)->group(function () {
            Route::prefix("akun-guru")->group(function () {
                Route::get("/", "index")->name("modules.guru.index");
                Route::get("/create", "create")->name("modules.guru.create");
                Route::post("/", "store")->name("modules.guru.store");
                Route::get("/{id}/edit", "edit")->name("modules.guru.edit");
                Route::put("/{id}", "update")->name("modules.guru.update");
                Route::delete("/{id}", "destroy")->name("modules.guru.destroy");
            });
        });

        Route::controller(SiswaController::class)->group(function () {
            Route::prefix("siswa")->group(function () {
                Route::get("/", "index")->name("modules.siswa.index");
                Route::get("/create", "create")->name("modules.siswa.create");
                Route::post("/", "store")->name("modules.siswa.store");
                Route::get("/{id}/edit", "edit")->name("modules.siswa.edit");
                Route::put("/{id}", "update")->name("modules.siswa.update");
                Route::delete("/{id}", "destroy")->name("modules.siswa.destroy");
            });
        });

    });
    Route::get("logout", [LoginController::class, "logout"])->name("authorization.logout");
});

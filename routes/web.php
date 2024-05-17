<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Master\KelasController;
use App\Http\Controllers\Master\TahunAjaranController;
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

        Route::prefix("master")->group(function() {
            Route::controller(KelasController::class)->group(function() {
                Route::prefix("kelas")->group(function() {
                    Route::get("/", "index")->name("modules.master.kelas");
                    Route::post("/", "store")->name("modules.master.kelas.store");
                    Route::get("/{id}/edit", "edit")->name("modules.master.kelas.edit");
                    Route::put("/{id}", "update")->name("modules.master.kelas.update");
                    Route::delete("/{id}", "destroy")->name("modules.master.kelas.destroy");
                });
            });

            Route::controller(TahunAjaranController::class)->group(function() {
                Route::prefix("tahun_ajaran")->group(function() {
                    Route::get("/", "index")->name("modules.master.tahun_ajaran");
                    Route::post("/", "store")->name("modules.master.tahun_ajaran.store");
                    Route::get("/{id}/edit", "edit")->name("modules.master.tahun_ajaran.edit");
                    Route::put("/{id}", "update")->name("modules.master.tahun_ajaran.update");
                    Route::put("/{id}/status", "change")->name("modules.master.tahun_ajaran.change");
                    Route::delete("/{id}", "destroy")->name("modules.master.tahun_ajaran.destroy");
                });
            });
        });

    });
    Route::get("logout", [LoginController::class, "logout"])->name("authorization.logout");
});

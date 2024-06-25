<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\DataSiswaWakelController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\KelasController;
use App\Http\Controllers\Master\KelompokPenilaianController;
use App\Http\Controllers\Master\KelompokRapotController;
use App\Http\Controllers\Master\PelajaranController;
use App\Http\Controllers\Master\TahunAjaranController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\Pengaturan\GantiPasswordController;
use App\Http\Controllers\Penilaian\HafalanHarianController;
use App\Http\Controllers\Report\Hafalan\NilaiHarianController;
use App\Http\Controllers\Report\Hafalan\NilaiUjianController;
use App\Http\Controllers\Report\Nilai\NilaiPerPertemuanController;
use App\Http\Controllers\Settings\ProfilAkunController;
use App\Http\Controllers\Settings\ProfilMadrasahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliKelasController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => ["guest"]], function () {
    Route::controller(LoginController::class)->group(function () {
        Route::prefix("login")->group(function () {
            Route::get("/", "index")->name("authorization.login");
            Route::post("/", "process")->name("authorization.process");
        });
        Route::get("/", "index");
    });
});

Route::group(["middleware" => ["autentikasi"]], function () {
    Route::prefix("modules")->group(function () {
        Route::controller(AppController::class)->group(function () {
            Route::get("/dashboard", "dashboard")->name("modules.dashboard");
        });

        Route::group(["middleware" => ["can:admin"]], function () {
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

            Route::controller(AdminController::class)->group(function () {
                Route::prefix("akun-admin")->group(function () {
                    Route::get("/", "index")->name("modules.admin.index");
                    Route::post("/", "store")->name("modules.admin.store");
                    Route::get("/{id}/edit", "edit")->name("modules.admin.edit");
                    Route::put("/{id}", "update")->name("modules.admin.update");
                    Route::delete("/{id}", "destroy")->name("modules.admin.destroy");
                });
            });

            Route::prefix("master")->group(function () {
                Route::controller(KelasController::class)->group(function () {
                    Route::prefix("kelas")->group(function () {
                        Route::get("/", "index")->name("modules.master.kelas");
                        Route::post("/", "store")->name("modules.master.kelas.store");
                        Route::get("/{id}/edit", "edit")->name("modules.master.kelas.edit");
                        Route::put("/{id}", "update")->name("modules.master.kelas.update");
                        Route::delete("/{id}", "destroy")->name("modules.master.kelas.destroy");
                    });
                });

                Route::controller(KelompokRapotController::class)->group(function () {
                    Route::prefix("kelompok-rapot")->group(function () {
                        Route::get("/", "index")->name("modules.master.kelompok-rapot.index");
                        Route::post("/", "store")->name("modules.master.kelompok-rapot.store");
                        Route::get("/{id}/edit", "edit")->name("modules.master.kelompok-rapot.edit");
                        Route::put("/{id}", "update")->name("modules.master.kelompok-rapot.update");
                        Route::delete("/{id}", "destroy")->name("modules.master.kelompok-rapot.destroy");
                    });
                });

                Route::controller(KelompokPenilaianController::class)->group(function() {
                    Route::prefix("kelompok-penilaian")->group(function() {
                        Route::get("/", "index")->name("modules.master.kelompok-penilaian.index");
                        Route::post("/", "store")->name("modules.master.kelompok-penilaian.store");
                        Route::get("/{id}/edit", "edit")->name("modules.master.kelompok-penilaian.edit");
                        Route::put("/{id}", "update")->name("modules.master.kelompok-penilaian.update");
                        Route::delete("/{id}", "destroy")->name("modules.master.kelompok-penilaian.destroy");
                    });
                });

                Route::controller(KategoriController::class)->group(function() {
                    Route::prefix("kategori")->group(function() {
                        Route::get("/", "index")->name("modules.master.kategori.index");
                        Route::post("/", "store")->name("modules.master.kategori.store");
                        Route::get("/{id}/edit", "edit")->name("modules.master.kategori.edit");
                        Route::put("/{id}", "update")->name("modules.master.kategori.update");
                        Route::delete("/{id}", "destroy")->name("modules.master.kategori.destroy");
                    });
                });

                Route::controller(TahunAjaranController::class)->group(function () {
                    Route::prefix("tahun_ajaran")->group(function () {
                        Route::get("/", "index")->name("modules.master.tahun_ajaran");
                        Route::post("/", "store")->name("modules.master.tahun_ajaran.store");
                        Route::get("/{id}/edit", "edit")->name("modules.master.tahun_ajaran.edit");
                        Route::put("/{id}", "update")->name("modules.master.tahun_ajaran.update");
                        Route::put("/{id}/status", "change")->name("modules.master.tahun_ajaran.change");
                        Route::delete("/{id}", "destroy")->name("modules.master.tahun_ajaran.destroy");
                    });
                });

                Route::controller(PelajaranController::class)->group(function() {
                    Route::prefix("pelajaran")->group(function() {
                        Route::get("/", "index")->name("modules.master.pelajaran.index");
                        Route::post("/", "store")->name("modules.master.pelajaran.store");
                        Route::get("/{id}/edit", "edit")->name("modules.master.pelajaran.edit");
                        Route::put("/{id}", "update")->name("modules.master.pelajaran.update");
                        Route::delete("/{id}", "destroy")->name("modules.master.pelajaran.destroy");
                    });
                });
            });

            Route::controller(NilaiHarianController::class)->group(function() {
                Route::prefix("laporan")->group(function() {
                    Route::prefix("hafalan")->group(function() {
                        Route::get("/{id}", "index")->name("modules.report.hafalan.harian.index");
                        Route::get("/{kategori}/{id}", "show")->name("modules.report.hafalan.harian.show");
                        Route::get("/{id}/download/data", "download")->name("modules.report.hafalan.download");
                    });
                });
            });

            Route::controller(NilaiPerPertemuanController::class)->group(function() {
                Route::prefix("laporan")->group(function() {
                    Route::prefix("nilai-per-pertemuan")->group(function() {
                        Route::get("/", "index")->name("modules.report.nilai-per-pertemuan.index");
                        Route::get("/{id}", "show")->name("modules.report.nilai-per-pertemuan.show");
                    });
                });
            });

            Route::controller(NilaiUjianController::class)->group(function() {
                Route::prefix("laporan")->group(function() {
                    Route::prefix("hafalan")->group(function() {
                        Route::prefix("ujian")->group(function() {
                            Route::get("/", "index")->name("modules.report.hafalan.ujian.index");
                            Route::get("/{id}", "show")->name("modules.report.hafalan.ujian.show");
                        });
                    });
                });
            });
        });

        Route::prefix("master")->group(function() {
            Route::controller(SiswaController::class)->group(function() {
                Route::prefix("siswa")->group(function() {
                    Route::get("/", "index")->name("modules.master-wali.siswa.index");
                });
            });
        });

        Route::controller(OrangTuaController::class)->group(function() {
            Route::prefix("orang-tua")->group(function() {
                Route::get("/", "index")->name("modules.master.orang-tua.index");
                Route::get("/{id}/data-anak", "showAnak")->name("modules.master.orang-tua.show-anak");
                Route::get("/{id}/edit", "edit")->name("modules.master.orang-tua.edit");
                Route::put("/{id}", "update")->name("modules.master.orang-tua.update");
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

        Route::controller(WaliKelasController::class)->group(function() {
            Route::prefix("wali-kelas")->group(function() {
                Route::get("/", "index")->name("modules.walikelas.index");
                Route::post("/", "store")->name("modules.walikelas.store");
                Route::get("/{id}/edit", "edit")->name("modules.walikelas.edit");
                Route::put("/{id}", "update")->name("modules.walikelas.update");
                Route::delete("/{id}", "destroy")->name("modules.walikelas.destroy");
            });
        });

        Route::controller(DataSiswaWakelController::class)->group(function() {
            Route::prefix("data-siswa")->group(function() {
                Route::get("/", "index")->name("modules.wakel.siswa.index");
            });
        });

        Route::prefix("pengaturan")->group(function () {
            Route::controller(ProfilMadrasahController::class)->group(function () {
                Route::get("/profil", "profil")->name("modules.pengaturan.profil");
                Route::post("/profil", "store")->name("modules.pengaturan.profil.store");
                Route::put("/profil/", "update")->name("modules.pengaturan.profil.update");
            });
        });

        Route::controller(ProfilAkunController::class)->group(function() {
            Route::prefix("akun")->group(function() {
                Route::prefix("profil-saya")->group(function() {
                    Route::get("/", "index")->name("modules.akun.profil");
                    Route::put("/{id}", "update")->name("modules.akun.profil.update");
                    Route::get("/{id}/lihat-profil", "showProfil")->name("modules.akun.profil.show-profil");
                    Route::put("/{id}/update-image", "updateImage")->name("modules.akun.profil.update-image");
                });
            });
        });

        Route::prefix("penilaian")->group(function() {
            Route::controller(HafalanHarianController::class)->group(function() {
                Route::get("/{id}", "index")->name("modules.penilaian.harian.index");
                Route::get("/search/materi", 'search')->name("modules.penilaian.harian.search");
                Route::post("/{kategori}/store", "store")->name("modules.penilaian.harian.store");
                Route::get("/{kategori}/{id}/edit", "edit")->name("modules.penilaian.harian.edit");
                Route::put("/{kategori}/{id}", "update")->name("modules.penilaian.harian.update");
            });
        });


        Route::controller(GantiPasswordController::class)->group(function() {
            Route::prefix("ganti-password")->group(function() {
                Route::put("/{id}", "update")->name("modules.pengaturan.ganti-password.update");
            });
        });
    });
    Route::get("logout", [LoginController::class, "logout"])->name("authorization.logout");
});

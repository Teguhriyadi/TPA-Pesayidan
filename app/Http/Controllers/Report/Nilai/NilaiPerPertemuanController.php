<?php

namespace App\Http\Controllers\Report\Nilai;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiPerPertemuanController extends Controller
{
    protected $nilai, $tahunAjaran;

    public function __construct()
    {
        $this->nilai = new Nilai();
        $this->tahunAjaran = new TahunAjaran();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $tahunAjaran = $this->tahunAjaran->where("status", "1")->first();

            $data = [
                "nilai" => $this->nilai->where("tahun_ajaran_id", $tahunAjaran->id)->get(),
            ];

            DB::commit();

            return view("modules.pages.report.nilai-per-pertemuan.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function show($id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "detail" => $this->nilai->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.report.nilai-per-pertemuan.detail", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

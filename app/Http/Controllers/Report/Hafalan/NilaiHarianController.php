<?php

namespace App\Http\Controllers\Report\Hafalan;

use App\Http\Controllers\Controller;
use App\Models\HafalanHarian;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class NilaiHarianController extends Controller
{
    protected $hafalanHarian, $tahunAjaran;

    public function __construct()
    {
        $this->hafalanHarian = new HafalanHarian();
        $this->tahunAjaran = new TahunAjaran();
    }

    public function index(Request $request)
    {
        try {

            DB::beginTransaction();

            $segments = $request->segments();

            $lastSegment = end($segments);

            $tahunAjaran = $this->tahunAjaran->where("status", "1")->first();

            if ($lastSegment == "harian") {
                $data["hafalanHarian"] = $this->hafalanHarian->where("tahunAjaranId", $tahunAjaran->id)->where("kategori", "HAFALAN")->get();
                $data["kategori"] = "harian";
            } else if ($lastSegment == "ujian") {
                $data["hafalanHarian"] = $this->hafalanHarian->where("tahunAjaranId", $tahunAjaran->id)->where("kategori", "UJIAN")->get();
                $data["kategori"] = "ujian";
            }

            DB::commit();

            return view("modules.pages.report.hafalan.harian.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function show($kategori, $id)
    {
        try {

            DB::beginTransaction();

            $data = [
                "kategori" => $kategori,
                "detail" => $this->hafalanHarian->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.report.hafalan.harian.show", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }

    public function download(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $segments = $request->segments();

            $tahunAjaran = $this->tahunAjaran->where("status", "1")->first();

            if ($segments[3] == "harian") {
                $hafalan = $this->hafalanHarian->where("tahunAjaranId", $tahunAjaran->id)->where("kategori", "HAFALAN")->get();
            } else if ($segments[3] == "ujian") {
                $hafalan = $this->hafalanHarian->where("tahunAjaranId", $tahunAjaran->id)->where("kategori", "UJIAN")->get();
            }

            $kategori = $segments[3];

            $pdf = PDF::loadView("modules.pages.report.hafalan.harian.download", ["hafalan" => $hafalan, "kategori" => $kategori])->setPaper("a3");

            DB::commit();

            return $pdf->download("Laporan_Hafalan_" . $kategori . ".pdf");

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

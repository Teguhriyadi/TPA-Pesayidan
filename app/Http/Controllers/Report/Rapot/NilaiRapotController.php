<?php

namespace App\Http\Controllers\Report\Rapot;

use App\Helpers\NumberToTextHelper;
use App\Http\Controllers\Controller;
use App\Models\AspekPenilaian;
use App\Models\Rapot;
use App\Models\RapotDetail;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiRapotController extends Controller
{
    protected $rapot, $tahunAjaran, $rapotDetail, $aspekPenilaian;

    public function __construct()
    {
        $this->rapot = new Rapot();
        $this->tahunAjaran = new TahunAjaran();
        $this->rapotDetail = new RapotDetail();
        $this->aspekPenilaian = new AspekPenilaian();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $tahunAjaran = $this->tahunAjaran->where("status", "1")->first();

            $data = [
                "rapot" => $this->rapot->where("tahun_ajaran_id", $tahunAjaran->id)->get()
            ];

            DB::commit();

            return view("modules.pages.report.rapot.index", $data);

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
                "detailRapot" => $this->rapotDetail->where("rapot_id", $id)->get()
            ];

            foreach ($data["detailRapot"] as $item) {
                $item->nilai_teks = NumberToTextHelper::convert($item->nilai);
            }

            $data["aspekPenilaian"] = $this->aspekPenilaian->where("rapot_id", $id)->first();

            DB::commit();

            return view("modules.pages.report.rapot.show", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

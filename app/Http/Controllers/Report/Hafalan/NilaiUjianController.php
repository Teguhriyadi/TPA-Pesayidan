<?php

namespace App\Http\Controllers\Report\Hafalan;

use App\Http\Controllers\Controller;
use App\Models\HafalanUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiUjianController extends Controller
{

    protected $hafalanUjian;

    public function __construct()
    {
        $this->hafalanUjian = new HafalanUjian();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "hafalanUjian" => $this->hafalanUjian->get()
            ];

            DB::commit();

            return view("modules.pages.report.hafalan.ujian.index", $data);

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
                "detail" => $this->hafalanUjian->where("id", $id)->first()
            ];

            DB::commit();

            return view("modules.pages.report.hafalan.ujian.show", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

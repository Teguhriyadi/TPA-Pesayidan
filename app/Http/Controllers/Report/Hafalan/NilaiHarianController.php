<?php

namespace App\Http\Controllers\Report\Hafalan;

use App\Http\Controllers\Controller;
use App\Models\HafalanHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiHarianController extends Controller
{
    protected $hafalanHarian;

    public function __construct()
    {
        $this->hafalanHarian = new HafalanHarian();
    }

    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [
                "hafalanHarian" => $this->hafalanHarian->get()
            ];

            DB::commit();

            return view("modules.pages.report.hafalan.harian.index", $data);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("modules.dashboard")->with("error", $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\UnitService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public UnitService $unitService;
    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function index()
    {
        $data['unit'] = $this->unitService->get(\Auth::guard('admin')->user()->sektor->first()->id);
        return view('unit.index', $data);
    }

    public function prosesTambah(Request $request)
    {
        $data = $request->validate([
            "nama_unit" => "required"
        ]);

        $data["id_sektor"] = \Auth::guard('admin')->user()->sektor->first()->id;
        try {
            if($this->unitService->tambah($data))
            {
                return redirect()->back()->with(AlertFormatter::success("Unit berhasil di tambah"));
            }
            return redirect()->back()->with(AlertFormatter::danger("Unit gagal di tambah"));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Unit gagal di tambah. " . $e->getMessage()));
        }
    }
}

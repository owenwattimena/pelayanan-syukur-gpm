<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\SektorService;
use App\Services\UnitService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public UnitService $unitService;
    public SektorService $sektorService;
    public function __construct(SektorService $sektorService, UnitService $unitService)
    {
        $this->sektorService = $sektorService;
        $this->unitService = $unitService;
    }

    public function index(Request $request)
    {
        $data['id_sektor'] = 0;
        $data['sektor'] = $this->sektorService->get();

        if($request->query('id_sektor'))
        {
            $data['id_sektor'] = $request->query('id_sektor');
            $data['unit'] = $this->unitService->get($request->query('id_sektor'));
        }
        return view('unit.index', $data);
    }

    public function prosesTambah(Request $request, $idSektor)
    {
        $data = $request->validate([
            "nama_unit" => "required"
        ]);

        $data["id_sektor"] = $idSektor;
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
    public function prosesUbah(Request $request, $idSektor, $idUnit)
    {
        $data = $request->validate([
            "nama_unit" => "required"
        ]);

        $data["id_sektor"] = $idSektor;
        try {
            if($this->unitService->ubah($data, $idUnit))
            {
                return redirect()->back()->with(AlertFormatter::success("Unit berhasil di tambah"));
            }
            return redirect()->back()->with(AlertFormatter::danger("Unit gagal di tambah"));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Unit gagal di tambah. " . $e->getMessage()));
        }
    }
    public function prosesHapus(Request $request, $idSektor, $idUnit)
    {

        try {
            if($this->unitService->hapus($idUnit))
            {
                return redirect()->back()->with(AlertFormatter::success("Unit berhasil dihapus"));
            }
            return redirect()->back()->with(AlertFormatter::danger("Unit gagal dihapus"));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Unit gagal dihapus. " . $e->getMessage()));
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\KelahiranService;
use App\Services\UnitService;
use Illuminate\Http\Request;

class KelahiranController extends Controller
{
    public KelahiranService $kelahiranService;
    public UnitService $unitService;

    public function __construct(KelahiranService $kelahiranService,  UnitService $unitService)
    {
        $this->kelahiranService = $kelahiranService;
        $this->unitService = $unitService;
    }
    public function index()
    {
        $data['kelahiran'] = $this->kelahiranService->getBySektor(\Auth::guard('admin')->user()->sektor->first()->id);
        $data['unit'] = $this->unitService->get(\Auth::guard('admin')->user()->sektor->first()->id);
        return view('pelayanan-kelahiran.index', $data);
    }
    public function tambah(Request $request)
    {
        $data = $request->validate([
            "nama" => "required",
            "tanggal" => "required",
            "jam" => "required",
            "alamat" => "required",
            "id_unit" => "required",
        ]);

        try {
            if($this->kelahiranService->tambah($data))
            {
                return redirect()->back()->with(AlertFormatter::success("Data kelahiran berhasil ditambahkan"));
            }
            return redirect()->back()->with(AlertFormatter::danger("Data kelahiran gagal ditambahkan"));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Data kelahiran gagal ditambahkan. " . $e->getMessage()));
        }
    }
}

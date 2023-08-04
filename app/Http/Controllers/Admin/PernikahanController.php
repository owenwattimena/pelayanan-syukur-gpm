<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\PernikahanService;
use App\Services\UnitService;
use Illuminate\Http\Request;

class PernikahanController extends Controller
{
    public PernikahanService $pernikahanService;
    public UnitService $unitService;

    public function __construct(PernikahanService $pernikahanService,  UnitService $unitService)
    {
        $this->pernikahanService = $pernikahanService;
        $this->unitService = $unitService;
    }
    public function index()
    {
        $data['pernikahan'] = $this->pernikahanService->getBySektor(\Auth::guard('admin')->user()->sektor->first()->id);
        $data['unit'] = $this->unitService->get(\Auth::guard('admin')->user()->sektor->first()->id);

        return view("pelayanan-pernikahan.index", $data);
    }

    public function tambah(Request $request)
    {
        $data = $request->validate([
            "nama_pria" => "required",
            "nama_wanita" => "required",
            "tanggal" => "required",
            "jam" => "required",
            "alamat" => "required",
            "id_unit" => "required",
        ]);

        try {
            if($this->pernikahanService->tambah($data))
            {
                return redirect()->back()->with(AlertFormatter::success("Data pernikahan berhasil ditambahkan"));
            }
            return redirect()->back()->with(AlertFormatter::danger("Data pernikahan gagal ditambahkan"));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Data pernikahan gagal ditambahkan. " . $e->getMessage()));
        }
    }
}

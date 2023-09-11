<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\JemaatService;
use App\Services\UnitService;
use Illuminate\Http\Request;

class JemaatController extends Controller
{
    private UnitService $unitService;
    private JemaatService $jemaatService;
    public function __construct(UnitService $unitService, JemaatService $jemaatService)
    {
        $this->unitService = $unitService;
        $this->jemaatService = $jemaatService;
    }
    public function index()
    {
        $user = \Auth::guard('admin')->user();
        $data['unit'] = $this->unitService->get($user->sektor->first()->id);

        return view('jemaat.index', $data);
    }

    public function prosesTambah(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            "no_kk" => "required",
            "nama_lengkap" => "required",
            "status_keluarga" => "required",
            "jenis_kelamin" => "required",
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required",
            "status_domisili" => "required",
            "status_menikah" => "required",
            "alamat" => "required",
            "id_unit" => "required"
        ]);

        try {
            if ($this->jemaatService->create($data)) {
                return redirect()->back()->with(AlertFormatter::success("Data jemaat berhasil ditambahkan!"));
            }
            return redirect()->back()->with(AlertFormatter::danger("Data jemaat gagal ditambahkan!"));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Data jemaat gagal ditambahkan! " . $e->getMessage()));
        }
    }
}

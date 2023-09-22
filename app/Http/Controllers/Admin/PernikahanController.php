<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\PernikahanService;
use App\Services\UnitService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PernikahanController extends Controller
{
    public PernikahanService $pernikahanService;
    public UnitService $unitService;

    public function __construct(PernikahanService $pernikahanService,  UnitService $unitService)
    {
        $this->pernikahanService = $pernikahanService;
        $this->unitService = $unitService;
    }
    public function index(Request $request)
    {
        $date = Carbon::now();
        $data['month'] = $date->month;
        if($request->query('month'))
        {
            $data['month'] = $request->query('month');
        }

        // $data['pernikahan'] = $this->pernikahanService->getBySektor(\Auth::guard('admin')->user()->sektor->first()->id);
        $query = DB::table('jemaat as l')->select(['l.nama_lengkap as suami', 'p.nama_lengkap as istri', 'l.tanggal_menikah', DB::raw("DATE_PART('YEAR', current_date) - DATE_PART('YEAR',l.tanggal_menikah)  AS usia"), 'l.id_unit', 'u.nama_unit', 'l.alamat'])
            ->join('jemaat as p', 'l.no_kk', '=', 'p.no_kk')
            ->where('l.status_keluarga', 'Kepala keluarga')
            ->where('p.status_keluarga', 'Istri')
            ->join('unit as u', 'l.id_unit', '=', 'u.id');

        $query = $query->whereMonth('l.tanggal_menikah', $data['month']);

        $data['pernikahan'] = $query->get();
        // dd($data);
        $data['unit'] = $this->unitService->get(Auth::guard('admin')->user()->sektor->first()->id);
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

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\JemaatService;
use App\Services\KelahiranService;
use App\Services\PernikahanService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Monolog\Formatter\JsonFormatter;

class PelayananController extends Controller
{
    private PernikahanService $pernikahanService;
    private KelahiranService $kelahiranService;
    private JemaatService $jemaatService;
    public function __construct(PernikahanService $pernikahanService, KelahiranService $kelahiranService, JemaatService $jemaatService)
    {
        $this->pernikahanService = $pernikahanService;
        $this->kelahiranService = $kelahiranService;
        $this->jemaatService = $jemaatService;
    }

    public function pernikahan(Request $request)
    {
        $limit = $request->query('limit');
        $user = $request->user();
        // $data = $this->pernikahanService->getByUnit($user->unit->first()->id, limit: $limit);
        $dateAwal = Carbon::now();
        $dateAkhir = Carbon::now()->addDays(40);
        $awal = Carbon::create(null, $dateAwal->month, $dateAwal->day);
        $akhir = Carbon::create(null, $dateAkhir->month, $dateAkhir->day);
        $data = $this->jemaatService->getPernikahan($awal, $akhir, $user->unit->first()->id, limit: $limit);
        return \App\Helpers\JsonFormatter::success($data, message: 'Data pelayanan pernikahan unit.');
    }

    public function kelahiran(Request $request)
    {
        $limit = $request->query('limit');
        $user = $request->user();
        // $data = $this->kelahiranService->getByUnit($user->unit->first()->id, limit: $limit);
        $dateAwal = Carbon::now();
        $dateAkhir = $dateAwal->addDays(60);
        $awal = Carbon::create(null, $dateAwal->month, $dateAwal->day);
        $akhir = Carbon::create(null, $dateAkhir->month, $dateAkhir->day);
        $data = $this->jemaatService->getKelahiran($awal, $akhir, $user->unit->first()->id,  limit: $limit);
        return \App\Helpers\JsonFormatter::success($data, message: 'Data pelayanan kelahiran unit.');
    }
}

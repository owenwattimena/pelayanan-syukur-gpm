<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\KelahiranService;
use App\Services\PernikahanService;
use Illuminate\Http\Request;
use Monolog\Formatter\JsonFormatter;

class PelayananController extends Controller
{
    private PernikahanService $pernikahanService;
    private KelahiranService $kelahiranService;
    public function __construct(PernikahanService $pernikahanService, KelahiranService $kelahiranService)
    {
        $this->pernikahanService = $pernikahanService;
        $this->kelahiranService = $kelahiranService;
    }
    public function pernikahan(Request $request)
    {
        $user = $request->user();
        $data = $this->pernikahanService->getByUnit($user->unit->first()->id);
        return \App\Helpers\JsonFormatter::success($data, message: 'Data pelayanan pernikahan unit.');
    }
    public function kelahiran(Request $request)
    {
        $user = $request->user();
        $data = $this->kelahiranService->getByUnit($user->unit->first()->id);
        return \App\Helpers\JsonFormatter::success($data, message: 'Data pelayanan kelahiran unit.');
    }
}

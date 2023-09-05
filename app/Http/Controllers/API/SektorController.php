<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonFormatter;
use App\Http\Controllers\Controller;
use App\Services\SektorService;
use App\Services\UnitService;
use Illuminate\Http\Request;

class SektorController extends Controller
{
    private SektorService $sektorService;
    private UnitService $unitService;
    public function __construct(SektorService $sektorService, UnitService $unitService)
    {
        $this->sektorService = $sektorService;
        $this->unitService = $unitService;
    }
    public function sektor()
    {
        $data = $this->sektorService->get()->makeHidden(['created_at', 'updated_at']);
        return JsonFormatter::success($data);
    }
    public function unit(int $idSektor)
    {
        $data = $this->unitService->get($idSektor)->makeHidden(['created_at', 'updated_at']);
        return JsonFormatter::success($data);
    }

    public function detailUnit(Request $request, int $id)
    {
        $data = $this->unitService->getById($id);
        return JsonFormatter::success($data);
    }
}

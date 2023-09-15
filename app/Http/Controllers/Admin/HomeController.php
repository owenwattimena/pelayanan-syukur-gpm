<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SektorService;
use App\Services\UnitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private SektorService $sektorService;
    private UnitService $unitService;
    public function __construct(SektorService $sektorService, UnitService $unitService)
    {
        $this->sektorService = $sektorService;
        $this->unitService = $unitService;
    }
    public function index()
    {
        $user = Auth::guard('admin')->user();
        if($user->role == 'admin_jemaat')
        {
            $data['totalSektor'] = $this->sektorService->getTotal();
            $data['totalUnit'] = $this->unitService->getTotal();
            $data['totalPengurusSektor'] = $this->sektorService->getTotalPengurus();
            $data['totalPengurusUnit'] = $this->unitService->getTotalPengurus();
        }else{
            $idSektor = $user->sektor->first()->pivot->id_sektor;
            $data['totalUnit'] = $this->unitService->getTotal(idSektor: $idSektor);
            $data['totalPengurusUnit'] = $this->unitService->getTotalPengurus(idSektor: $idSektor);
        }

        return view('home.index', $data);
    }
}

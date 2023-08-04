<?php

namespace App\Repositories\Implement;
use App\Models\PengurusUnit;
use App\Models\Unit;
use App\Repositories\UnitRepository;
use Illuminate\Database\Eloquent\Collection;

class UnitRepoImplement implements UnitRepository
{
    private Unit $unit;
    private PengurusUnit $pengurusUnit;
    public function __construct(Unit $unit, PengurusUnit $pengurusUnit)
    {
        $this->unit = $unit;
        $this->pengurusUnit = $pengurusUnit;
    }
    public function get(int $id_sektor):Collection
    {
        return $this->unit->where('id_sektor', $id_sektor)->get();
    }

    public function tambah(array $data):Unit|null
    {
        return $this->unit->create($data);
    }

    public function tambahPengurus(array $data) : PengurusUnit|null
    {
        return $this->pengurusUnit->create($data);
    }

}

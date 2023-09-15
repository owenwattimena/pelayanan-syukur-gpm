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

    public function getById(int $id) : Unit{
        return $this->unit->with('sektor')->findOrFail($id);
    }

    public function tambah(array $data):Unit|null
    {
        return $this->unit->create($data);
    }
    public function ubah(array $data, int $idUnit): bool
    {
        return $this->unit->where('id', $idUnit)->update($data);
    }
    public function ubahUnitPengurus(array $data, $idUser): bool
    {
        return $this->pengurusUnit->where('id_user', $idUser)->update($data);
    }
    public function tambahPengurus(array $data) : PengurusUnit|null
    {
        return $this->pengurusUnit->create($data);
    }

    public function hapusPengurus(int $idUser) : bool
    {
        return $this->pengurusUnit->where('id_user', $idUser)->delete() > 0;
    }
    public function hapus(int $idUnit) : bool
    {
        return $this->unit->where('id', $idUnit)->delete() > 0;
    }
    public function getTotal(?int $idSektor = null):int
    {
        return $this->unit->count();
    }
    public function getTotalPengurus(?int $idSektor = null): int
    {
        if($idSektor != null)
        {
            $unit = $this->unit->where('id_sektor', $idSektor)->first();
            return $unit->pengurus->count();
        }
        return $this->pengurusUnit->count();
    }

}

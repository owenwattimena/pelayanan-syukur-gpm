<?php

namespace App\Repositories\Implement;
use App\Models\Pernikahan;
use App\Repositories\PernikahanRepository;
use Illuminate\Database\Eloquent\Collection;

class PernikahanRepoImplement implements PernikahanRepository
{
    private Pernikahan $pernikahanModel;

    public function __construct(Pernikahan $pernikahanModel)
    {
        $this->pernikahanModel = $pernikahanModel;
    }

    public function getBySektor(int $id_sektor) : Collection
    {
        return $this->pernikahanModel->with(['unit'=>function($query)use($id_sektor){
            return $query->where('id_sektor', $id_sektor);
        }])->get();
    }

    public function getByUnit(int $idUnit) : Collection
    {
        return $this->pernikahanModel->where('id_unit', $idUnit)->get();
    }

    public function tambah(array $data) : Pernikahan | null
    {
        return $this->pernikahanModel->create($data);
    }
}

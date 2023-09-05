<?php
namespace App\Repositories\Implement;
use App\Models\Kelahiran;
use App\Models\Pernikahan;
use App\Repositories\KelahiranRepository;
use Illuminate\Database\Eloquent\Collection;

class KelahiranRepoImplement implements KelahiranRepository
{
    private Kelahiran $kelahiranModel;
    public function __construct(Kelahiran $kelahiranModel)
    {
        $this->kelahiranModel = $kelahiranModel;
    }
    public function getBySektor(int $id_sektor) : Collection
    {
        return $this->kelahiranModel->with(['unit'=>function($query)use($id_sektor){
            return $query->where('id_sektor', $id_sektor);
        }])->get();
    }

    public function getByUnit(int $idUnit, ?int $limit = null) : Collection
    {
        return $this->kelahiranModel->where('id_unit', $idUnit)->get();
    }
    public function tambah(array $data) : Kelahiran | null
    {
        return $this->kelahiranModel->create($data);
    }
}

<?php
namespace App\Services\Implement;
use App\Repositories\PernikahanRepository;
use App\Services\PernikahanService;
use Illuminate\Database\Eloquent\Collection;

class PernikahanServiceImplement implements PernikahanService
{
    public PernikahanRepository $pernikahanRepo;
    public function __construct(PernikahanRepository $pernikahanRepo)
    {
        $this->pernikahanRepo = $pernikahanRepo;
    }
    public function getBySektor(int $id_sektor) : Collection
    {
        return $this->pernikahanRepo->getBySektor($id_sektor);
    }

    public function getByUnit(int $idUnit, ?int $limit = null) : Collection
    {
        return $this->pernikahanRepo->getByUnit($idUnit, limit: $limit);
    }
    public function tambah(array $data) : bool
    {
        if($this->pernikahanRepo->tambah($data)) return true;
        return false;
    }
}

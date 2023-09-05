<?php
namespace App\Services\Implement;
use App\Models\Unit;
use App\Repositories\UnitRepository;
use App\Services\UnitService;
use Illuminate\Database\Eloquent\Collection;

class UnitServiceImplement implements UnitService
{
    public UnitRepository $unitRepo;

    public function __construct(UnitRepository $unitRepo)
    {
        $this->unitRepo = $unitRepo;
    }
    public function get(int $id_sektor): Collection
    {
        return $this->unitRepo->get($id_sektor);
    }
    public function getById(int $id) : Unit
    {
        return $this->unitRepo->getById($id);
    }
    public function tambah(array $data): Unit|null
    {
        return $this->unitRepo->tambah($data);
    }
    public function ubah(array $data, int $idUnit): bool
    {
        return $this->unitRepo->ubah($data, $idUnit);
    }
    public function hapus(int $idUnit) : bool
    {
        return $this->unitRepo->hapus($idUnit);
    }
}

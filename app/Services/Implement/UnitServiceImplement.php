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

    public function tambah(array $data): Unit|null
    {
        return $this->unitRepo->tambah($data);
    }
}

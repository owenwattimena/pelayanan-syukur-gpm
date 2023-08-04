<?php
namespace App\Services\Implement;
use App\Repositories\KelahiranRepository;
use App\Services\KelahiranService;
use Illuminate\Database\Eloquent\Collection;

class KelahiranServiceImplement implements KelahiranService
{
    public KelahiranRepository $kelahiranRepo;
    public function __construct(KelahiranRepository $kelahiranRepo)
    {
        $this->kelahiranRepo = $kelahiranRepo;
    }
    public function getBySektor(int $id_sektor) : Collection
    {
        return $this->kelahiranRepo->getBySektor($id_sektor);
    }

    public function getByUnit(int $idUnit) : Collection
    {
        return $this->kelahiranRepo->getByUnit($idUnit);
    }
    public function tambah(array $data) : bool
    {
        if($this->kelahiranRepo->tambah($data)) return true;
        return false;
    }
}

<?php

namespace App\Services\Implement;
use App\Repositories\JemaatRepository;
use App\Services\JemaatService;
use Illuminate\Database\Eloquent\Collection;

class JemaatServiceImplement implements JemaatService
{

    private JemaatRepository $jemaatRepo;

    public function __construct(JemaatRepository $jemaatRepository)
    {
        $this->jemaatRepo = $jemaatRepository;
    }
    public function all(): Collection|null
    {
        return $this->jemaatRepo->all();
    }
    public function create(array $data) : bool
    {
        if($this->jemaatRepo->create($data)) return true;
        return false;
    }
    public function update(array $data, int $id) : bool
    {
        return $this->jemaatRepo->update($data, $id);
    }
    public function delete(array|int $ids) : bool
    {
        return $this->jemaatRepo->delete($ids);
    }
    public function getPernikahan($awal, $akhir, ?int $idUnit): \Illuminate\Support\Collection
    {
        return $this->jemaatRepo->getPernikahan($awal, $akhir, idUnit: $idUnit);
    }
    public function getKelahiran($awal, $akhir, ?int $idUnit): \Illuminate\Support\Collection
    {
        return $this->jemaatRepo->getKelahiran($awal, $akhir, idUnit: $idUnit);
    }
}

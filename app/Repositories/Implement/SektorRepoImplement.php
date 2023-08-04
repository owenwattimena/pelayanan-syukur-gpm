<?php

namespace App\Repositories\Implement;
use App\Models\PengurusSektor;
use App\Models\Sektor;
use App\Repositories\SektorRepository;
use Illuminate\Database\Eloquent\Collection;

class SektorRepoImplement implements SektorRepository
{

    private Sektor $modelSektor;
    private PengurusSektor $modelPengurusSektor;

    public function __construct(Sektor $modelSektor, PengurusSektor $modelPengurusSektor)
    {
        $this->modelSektor = $modelSektor;
        $this->modelPengurusSektor = $modelPengurusSektor;
    }

    public function get(): Collection
    {
        return $this->modelSektor->all();
    }

    public function tambah(array $data):Sektor|null
    {
        return $this->modelSektor->create($data);
    }
    public function tambahPengurus(array $data):PengurusSektor|null
    {
        return $this->modelPengurusSektor->create($data);
    }
}

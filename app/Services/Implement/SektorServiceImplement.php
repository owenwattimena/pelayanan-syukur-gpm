<?php

namespace App\Services\Implement;
use App\Models\PengurusSektor;
use App\Models\Sektor;
use App\Repositories\SektorRepository;
use App\Services\SektorService;
use Illuminate\Database\Eloquent\Collection;

class SektorServiceImplement implements SektorService
{

    public SektorRepository $sektorRepo;

    public function __construct(SektorRepository $sektorRepo)
    {
        $this->sektorRepo = $sektorRepo;
    }

    public function get(): Collection
    {
        return $this->sektorRepo->get();
    }

    public function tambah(array $data) : Sektor|null
    {
        return $this->sektorRepo->tambah($data);
    }
    public function tambahPengurus(array $data): PengurusSektor|null
    {
        return $this->sektorRepo->tambahPengurus($data);
    }
}

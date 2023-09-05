<?php

namespace App\Repositories;
use App\Models\Pernikahan;
use Illuminate\Database\Eloquent\Collection;

interface PernikahanRepository
{
    public function getBySektor(int $id_sektor) : Collection;
    public function getByUnit(int $idUnit, ?int $limit = null) : Collection;
    public function tambah(array $data) : Pernikahan | null;
}

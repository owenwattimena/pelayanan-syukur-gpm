<?php

namespace App\Repositories;
use App\Models\Pernikahan;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Collection1;

interface PernikahanRepository
{
    public function getBySektor(int $id_sektor) : Collection;
    public function getByUnit(int $idUnit, ?int $limit = null) : Collection;
    public function tambah(array $data) : Pernikahan | null;
    public function getTheDay(?int $day = 0) :  Collection1;
}

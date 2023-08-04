<?php
namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface PernikahanService
{
    public function getBySektor(int $id_sektor) : Collection;
    public function getByUnit(int $idUnit) : Collection;
    public function tambah(array $data) : bool;
}
<?php
namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface KelahiranService
{
    public function getBySektor(int $id_sektor) : Collection;
    public function getByUnit(int $idUnit, ?int $limit = null) : Collection;
    public function tambah(array $data) : bool;
}

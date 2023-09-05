<?php
namespace App\Repositories;
use App\Models\Kelahiran;
use Illuminate\Database\Eloquent\Collection;

interface KelahiranRepository
{
    public function getBySektor(int $id_sektor) : Collection;
    public function getByUnit(int $idUnit, ?int $limit = null) : Collection;
    public function tambah(array $data) : Kelahiran | null;
}

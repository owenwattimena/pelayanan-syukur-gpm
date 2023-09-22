<?php
namespace App\Repositories;
use App\Models\Kelahiran;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Collection1;
interface KelahiranRepository
{
    public function getBySektor(int $id_sektor) : Collection;
    public function getByUnit(int $idUnit, ?int $limit = null) : Collection;
    public function tambah(array $data) : Kelahiran | null;
    public function getTheDay(?int $day = 0) :  Collection1;
}

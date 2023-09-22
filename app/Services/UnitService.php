<?php
namespace App\Services;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Collection;

interface UnitService
{
    public function get(int $id_sektor):Collection;
    public function getById(int $id) : Unit;
    public function tambah(array $data): Unit|null;
    public function ubah(array $data, int $idUnit): bool;
    public function hapus(int $idUnit) : bool;
    public function getTotal(?int $idSektor = null):int;
    public function getTotalPengurus(?array $idsUnit = null):int;
}

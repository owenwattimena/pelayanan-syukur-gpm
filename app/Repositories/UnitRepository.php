<?php

namespace App\Repositories;
use App\Models\PengurusUnit;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Collection;

interface UnitRepository
{
    public function get(int $id_sektor): Collection;
    public function getById(int $id) : Unit;
    public function tambah(array $data): Unit|null;
    public function ubahUnitPengurus(array $data, $idUser): bool;
    public function ubah(array $data, int $idUnit): bool;
    public function tambahPengurus(array $data) : PengurusUnit|null;
    public function hapusPengurus(int $idUser) : bool;
    public function hapus(int $idUnit) : bool;

}

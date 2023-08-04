<?php

namespace App\Repositories;
use App\Models\PengurusUnit;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Collection;

interface UnitRepository
{
    public function get(int $id_sektor): Collection;
    public function tambah(array $data): Unit|null;
    public function tambahPengurus(array $data) : PengurusUnit|null;
}

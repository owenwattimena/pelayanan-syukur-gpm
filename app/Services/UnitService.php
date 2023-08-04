<?php
namespace App\Services;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Collection;

interface UnitService
{
    public function get(int $id_sektor):Collection;

    public function tambah(array $data): Unit|null;
}

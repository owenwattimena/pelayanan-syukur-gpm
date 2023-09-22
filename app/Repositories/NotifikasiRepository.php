<?php
namespace App\Repositories;
use App\Models\Notifikasi;
use Illuminate\Database\Eloquent\Collection;

interface NotifikasiRepository
{
    public function get(int $idUnit): Collection | null;
    public function save(array $data): Notifikasi | bool;
}

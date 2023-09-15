<?php
namespace App\Repositories;
use App\Models\PengurusSektor;
use App\Models\Sektor;
use Illuminate\Database\Eloquent\Collection;

interface SektorRepository{
    public function get(): Collection;
    public function tambah(array $data) : Sektor | null ;
    public function ubah(array $data, int $id): bool;
    public function hapus(int $id): int;
    public function getPengurus(?int $id = null): Collection;
    public function tambahPengurus(array $data) : PengurusSektor | null ;
    public function ubahPengurus(array $data, int $id) : bool;
    public function hapusPengurus(int $id) : bool;
    public function getTotal() : int;
    public function getTotalPengurus() : int;
}

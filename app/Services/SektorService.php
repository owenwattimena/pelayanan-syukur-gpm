<?php
namespace App\Services;
use App\Models\PengurusSektor;
use App\Models\Sektor;
use Illuminate\Database\Eloquent\Collection;

interface SektorService{
    public function get(): Collection;
    public function tambah(array $data): Sektor|null;
    public function ubah(array $data, int $id): bool;
    public function hapus(int $id): bool;
    public function getPengurus(): Collection;
    public function tambahPengurus(array $data): PengurusSektor|null;
    public function ubahPengurus(array $data, int $idPengurus) : bool;
    public function hapusPengurus(int $id) : bool;
    public function getTotal() : int;
    public function getTotalPengurus() : int;

}

<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{
    public function tambah(array $data) : User|null;

    public function get(?int $idSektor = null) : Collection;

    public function verifikasi(int $id) : bool;

    public function delete(array|int $ids) : bool;
}

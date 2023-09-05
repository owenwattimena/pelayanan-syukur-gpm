<?php
namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface UserService
{
    public function tambah(array $data):bool;
    public function ubah(array $data, int $id):bool;

    public function get() : Collection;

    public function verifikasi(int $id) : bool;

    public function delete(array|int $ids) : bool;
}

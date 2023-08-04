<?php
namespace App\Repositories;
use App\Models\Admin;

interface AdminRepository {
    public function daftar(array $data) : Admin|null;
}

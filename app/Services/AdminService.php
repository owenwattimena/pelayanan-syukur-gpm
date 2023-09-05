<?php
namespace App\Services;

interface AdminService{
    public function daftar(array $data, ?string $role = 'admin_sektor'): bool;
}

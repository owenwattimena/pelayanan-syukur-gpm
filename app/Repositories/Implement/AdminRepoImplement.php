<?php
namespace App\Repositories\Implement;

use App\Models\Admin;
use App\Repositories\AdminRepository;

class AdminRepoImplement implements AdminRepository
{
    private Admin $adminModel;

    public function __construct(Admin $adminModel)
    {
        $this->adminModel = $adminModel;
    }
    public function daftar(array $data) : Admin|null{
        return $this->adminModel->create($data);
    }
}

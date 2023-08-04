<?php

namespace App\Services\Implement;
use App\Models\PengurusSektor;
use App\Repositories\AdminRepository;
use App\Repositories\SektorRepository;
use App\Services\AdminService;

class AdminServiceImplement implements AdminService
{
    private AdminRepository $adminRepo;
    private SektorRepository $sektorRepo;


    public function __construct(AdminRepository $adminRepo, SektorRepository $sektorRepo)
    {
        $this->adminRepo = $adminRepo;
        $this->sektorRepo = $sektorRepo;
    }

    public function daftar(array $data):bool{
        // dd($data);
        $admin = $this->adminRepo->daftar($data);
        if(!is_numeric($data['sektor'])){
            $sektor = $this->sektorRepo->tambah(["nama_sektor" => $data['sektor']]);
            $id_sektor = $sektor->id;
        }else{
            $id_sektor = $data['sektor'];
        }

        if($this->sektorRepo->tambahPengurus([
            "id_admin" => $admin->id,
            "id_sektor" => $id_sektor
        ])) return true;
            return false;
    }
}

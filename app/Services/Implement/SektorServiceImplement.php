<?php

namespace App\Services\Implement;
use App\Models\PengurusSektor;
use App\Models\Sektor;
use App\Repositories\AdminRepository;
use App\Repositories\SektorRepository;
use App\Services\SektorService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SektorServiceImplement implements SektorService
{

    public SektorRepository $sektorRepo;
    public AdminRepository $adminRepo;

    public function __construct(SektorRepository $sektorRepo, AdminRepository $adminRepo)
    {
        $this->sektorRepo = $sektorRepo;
        $this->adminRepo = $adminRepo;
    }

    public function get(): Collection
    {
        return $this->sektorRepo->get();
    }

    public function tambah(array $data) : Sektor|null
    {
        return $this->sektorRepo->tambah($data);
    }
    public function ubah(array $data, int $id): bool
    {
        return $this->sektorRepo->ubah($data, $id);
    }
    public function hapus(int $id): bool
    {
        return $this->sektorRepo->hapus($id) > 0;
    }
    public function getPengurus(): Collection
    {
        return $this->sektorRepo->getPengurus();
    }
    public function tambahPengurus(array $data): PengurusSektor|null
    {
        return $this->sektorRepo->tambahPengurus($data);
    }

    public function ubahPengurus(array $data, int $idPengurus) : bool
    {
        return DB::transaction(function () use ($data, $idPengurus) {
            $pengurus = $this->sektorRepo->getPengurus(id:$idPengurus)->first();

            $this->sektorRepo->ubahPengurus([
                'id_admin' => $pengurus->id_admin,
                'id_sektor' => $data['sektor'],
            ], $idPengurus);
            $user = [
                'nama_lengkap' => $data['nama_lengkap'],
                'email' => $data['email'],
                'telepon' => $data['telepon'],
                'username' => $data['username'],
            ];
            if(isset($data['password']))
            {
                $user['password'] = $data['password'];
            }
            $this->adminRepo->ubah($user, $pengurus->id_admin);

            return true;
        });
    }

    public function hapusPengurus(int $id) : bool
    {
        return DB::transaction(function () use ($id) {
            $pengurus = $this->sektorRepo->getPengurus(id:$id)->first();
            $this->sektorRepo->hapusPengurus($id);
            $this->adminRepo->hapus($pengurus->id_admin);
            return true;
    });

    }
}

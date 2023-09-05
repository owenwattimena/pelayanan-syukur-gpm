<?php
namespace App\Services\Implement;

use App\Repositories\UnitRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UserServiceImplement implements UserService
{
    private UserRepository $userRepo;
    private UnitRepository $unitRepo;
    public function __construct(UserRepository $userRepo, UnitRepository $unitRepo)
    {
        $this->userRepo = $userRepo;
        $this->unitRepo = $unitRepo;
    }
    public function tambah(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = $this->userRepo->tambah($data);
            if ($user) {
                if (
                    $this->unitRepo->tambahPengurus([
                        'id_user' => $user->id,
                        'id_unit' => $data['id_unit']
                    ])
                )
                    return true;
                return false;
            }
            return false;
        });
    }

    public function ubah(array $data, int $id): bool
    {
        return DB::transaction(function () use ($data, $id) {
            $unit = [
                'id_user' => $id,
                'id_unit' => $data['id_unit']
            ];
            unset($data['id_unit']);
            $this->userRepo->ubah($data, $id); // update user
            $this->unitRepo->ubah($unit, $id); // update user unit
            return true;
        });
    }

    public function get(): Collection
    {
        return $this->userRepo->get();
    }

    public function verifikasi(int $id): bool
    {
        return $this->userRepo->verifikasi($id);
    }

    public function delete(array|int $ids): bool
    {
        return $this->userRepo->delete($ids);
    }
}

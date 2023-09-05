<?php
namespace App\Repositories\Implement;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class UserRepoImplement implements UserRepository
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }
    public function tambah(array $data):User | null
    {
        return $this->userModel->create($data);
    }

    public function ubah(array $data, int $id) : bool
    {
        return $this->userModel->where('id', $id)->update($data);
    }
    public function get(?int $idSektor = null) : Collection
    {
        return $this->userModel->all();
    }

    public function verifikasi(int $id):bool
    {
        $user = $this->userModel->findOrFail($id);
        $user->ccccc = Carbon::now();
        if($user->save()) return true;
            return false;
    }

    public function delete(array|int $ids):bool
    {
        return $this->userModel->destroy($ids);
    }
}

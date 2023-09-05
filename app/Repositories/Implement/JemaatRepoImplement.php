<?php
namespace App\Repositories\Implement;
use App\Models\Jemaat;
use App\Repositories\JemaatRepository;
use Illuminate\Database\Eloquent\Collection;

class JemaatRepoImplement implements JemaatRepository
{

    private Jemaat $jemaat;

    public function __construct(Jemaat $jemaat)
    {
        $this->jemaat = $jemaat;
    }

    public function all(): Collection|null
    {
        return $this->jemaat->all();
    }
    public function create(array $data) : Jemaat|null
    {
        return $this->jemaat->create($data);
    }
    public function update(array $data, int $id) : bool
    {
        return $this->jemaat->where('id', $id)->update($data);
    }
    public function delete(array|int $ids) : bool
    {
        return $this->jemaat->destroy($ids);
    }
}

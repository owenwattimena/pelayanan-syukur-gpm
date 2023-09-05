<?php

namespace App\Repositories\Implement;
use App\Models\PengurusSektor;
use App\Models\Sektor;
use App\Repositories\SektorRepository;
use Illuminate\Database\Eloquent\Collection;

class SektorRepoImplement implements SektorRepository
{

    private Sektor $modelSektor;
    private PengurusSektor $modelPengurusSektor;

    public function __construct(Sektor $modelSektor, PengurusSektor $modelPengurusSektor)
    {
        $this->modelSektor = $modelSektor;
        $this->modelPengurusSektor = $modelPengurusSektor;
    }

    public function get(): Collection
    {
        return $this->modelSektor->all();
    }

    public function tambah(array $data):Sektor|null
    {
        return $this->modelSektor->create($data);
    }

    public function ubah(array $data, int $id): bool
    {
        return $this->modelSektor->where('id', $id)->update($data);
    }
    public function hapus(int $id): int
    {
        return $this->modelSektor->destroy($id);
    }
    public function getPengurus(?int $id = null): Collection
    {
        $query = $this->modelPengurusSektor->query();

        if($id)
        {
            $query = $query->where('id', $id);
        }

        return $query->with(['admin' => function($query){
            return $query->where('role', 'admin_sektor');
        }])->get();
    }
    public function tambahPengurus(array $data):PengurusSektor|null
    {
        return $this->modelPengurusSektor->create($data);
    }

    public function ubahPengurus(array $data, int $id) : bool
    {
        return $this->modelPengurusSektor->where('id', $id)->update($data);
    }
    public function hapusPengurus(int $id) : bool
    {
        return $this->modelPengurusSektor->destroy($id) > 0;
    }
}

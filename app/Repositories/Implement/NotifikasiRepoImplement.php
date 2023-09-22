<?php

namespace App\Repositories\Implement;

use App\Models\Notifikasi;
use App\Repositories\NotifikasiRepository;
use Illuminate\Database\Eloquent\Collection;

class NotifikasiRepoImplement implements NotifikasiRepository
{
    private Notifikasi $notifikasiModel;

    public function __construct(Notifikasi $notifikasiModel)
    {
        $this->notifikasiModel = $notifikasiModel;
    }
    public function get(int $idUnit): Collection | null
    {
        return $this->notifikasiModel->where('id_unit', $idUnit)->get();
    }
    public function save(array $data): Notifikasi | bool
    {
        $isi = $data['isi'];
        $id_unit = $data['id_unit'];
        if($this->notifikasiModel->where('isi', $isi)->where('id_unit', $id_unit)->count() > 0) return true;
        return $this->notifikasiModel->create($data);
    }
}

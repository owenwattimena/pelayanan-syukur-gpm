<?php

namespace App\Repositories\Implement;
use App\Models\Pernikahan;
use App\Repositories\PernikahanRepository;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Collection1;
use Illuminate\Support\Carbon;

class PernikahanRepoImplement implements PernikahanRepository
{
    private Pernikahan $pernikahanModel;

    public function __construct(Pernikahan $pernikahanModel)
    {
        $this->pernikahanModel = $pernikahanModel;
    }

    public function getBySektor(int $id_sektor) : Collection
    {
        return $this->pernikahanModel->with(['unit'=>function($query)use($id_sektor){
            return $query->where('id_sektor', $id_sektor);
        }])->get();
    }

    public function getByUnit(int $idUnit, ?int $limit = null) : Collection
    {
        $query = $this->pernikahanModel->query();
        $query = $query->where('id_unit', $idUnit)->orderBy('created_at', 'DESC');
        if($limit)
        {
            $query = $query->limit($limit);
        }
        return $query->get();
    }

    public function tambah(array $data) : Pernikahan | null
    {
        return $this->pernikahanModel->create($data);
    }

    public function getTheDay(?int $day = 0) :  Collection1
    {
        $date = Carbon::now();
        $theDay = $date->addDays($day);
        $query = DB::table('jemaat as l')->select(['l.nama_lengkap as suami', 'p.nama_lengkap as istri', 'l.tanggal_menikah', DB::raw("DATE_PART('YEAR', current_date) - DATE_PART('YEAR',l.tanggal_menikah)  AS usia"),'l.id_unit', 'u.nama_unit', 'l.alamat'])
            ->join('jemaat as p', 'l.no_kk', '=', 'p.no_kk')
            ->where('l.status_keluarga', 'Kepala keluarga')
            ->where('p.status_keluarga', 'Istri')
            ->join('unit as u', 'l.id_unit', '=', 'u.id');

        $query = $query->whereMonth('l.tanggal_menikah', $theDay->month);
        $query = $query->whereDay('l.tanggal_menikah', $theDay->day);

        return $query->get();
    }
}

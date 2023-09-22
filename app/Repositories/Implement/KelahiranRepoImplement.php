<?php
namespace App\Repositories\Implement;
use App\Models\Kelahiran;
use App\Models\Pernikahan;
use App\Repositories\KelahiranRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Collection1;

class KelahiranRepoImplement implements KelahiranRepository
{
    private Kelahiran $kelahiranModel;
    public function __construct(Kelahiran $kelahiranModel)
    {
        $this->kelahiranModel = $kelahiranModel;
    }
    public function getBySektor(int $id_sektor) : Collection
    {
        return $this->kelahiranModel->with(['unit'=>function($query)use($id_sektor){
            return $query->where('id_sektor', $id_sektor);
        }])->get();
    }

    public function getByUnit(int $idUnit, ?int $limit = null) : Collection
    {
        return $this->kelahiranModel->where('id_unit', $idUnit)->get();
    }
    public function tambah(array $data) : Kelahiran | null
    {
        return $this->kelahiranModel->create($data);
    }

    public function getTheDay(?int $day = 0) :  Collection1
    {
        $date = Carbon::now();
        $theDay = $date->addDays($day);
        $query = DB::table('jemaat')->select(['nama_lengkap', 'tanggal_lahir', DB::raw("DATE_PART('YEAR', current_date) - DATE_PART('YEAR',tanggal_lahir)  AS usia"),'id_unit', 'u.nama_unit', 'alamat'])
            ->join('unit as u', 'id_unit', '=', 'u.id');

        $query = $query->whereMonth('tanggal_lahir', $theDay->month);
        $query = $query->whereDay('tanggal_lahir', $theDay->day);

        return $query->get();
    }
}

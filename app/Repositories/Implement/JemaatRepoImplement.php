<?php
namespace App\Repositories\Implement;
use App\Models\Jemaat;
use App\Repositories\JemaatRepository;
use DB;
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
    public function getPernikahan($awal, $akhir, ?int $idUnit): \Illuminate\Support\Collection
    {
        $query = DB::table('jemaat as l')->select(['l.nama_lengkap as suami', 'p.nama_lengkap as istri', 'l.tanggal_menikah', 'l.id_unit', 'u.nama_unit', 'l.alamat'])
            ->join('jemaat as p', 'l.no_kk', '=', 'p.no_kk')
            ->where('l.status_keluarga', 'Kepala keluarga')
            ->where('p.status_keluarga', 'Istri')
            ->join('unit as u', 'l.id_unit', '=', 'u.id');

        if ($idUnit != null) {
            $query = $query->where('l.id_unit', '=', $idUnit);
        }

        $query = $query->whereBetween(DB::raw('DATE_ADD(l.tanggal_menikah, INTERVAL YEAR(CURDATE()) - YEAR(l.tanggal_menikah) YEAR)'), [now(), now()->addDays(50)]);
        $query = $query->orderBy('l.tanggal_menikah');
        return $query->get();
    }

    public function getKelahiran($awal, $akhir, ?int $idUnit): \Illuminate\Support\Collection
    {
        $query = DB::table('jemaat')
            ->select(
                ['nama_lengkap', 'tanggal_lahir', 'id_unit', 'u.nama_unit', 'alamat']
            )->join('unit as u', 'id_unit', '=', 'u.id');

        $query = $query->whereBetween('l.tanggal_lahir', [$awal, $akhir]);
        if ($idUnit != null) {
            $query = $query->where('id_unit', '=', $idUnit);
        }
        $query = $query->orderBy('tanggal_lahir');
        return $query->get();
    }
}

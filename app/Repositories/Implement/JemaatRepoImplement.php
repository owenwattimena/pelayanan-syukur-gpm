<?php
namespace App\Repositories\Implement;
use App\Models\Jemaat;
use App\Repositories\JemaatRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
    public function getPernikahan($awal, $akhir, ?int $idUnit, ?int $limit = null): \Illuminate\Support\Collection
    {
        $query = DB::table('jemaat as l')->select(
                [
                    'l.id',
                    'l.nama_lengkap as suami',
                    'p.nama_lengkap as istri',
                    'l.tanggal_menikah',
                    // DB::raw('YEAR(' . Carbon::now() . ') - YEAR(l.tanggal_menikah) - (DATE_FORMAT(' . Carbon::now() . ', "%m%d") < DATE_FORMAT(l.tanggal_menikah, "%m%d")) AS usia'),
                    // DB::raw('YEAR(CURDATE()) - YEAR(l.tanggal_menikah) - (DATE_FORMAT(CURDATE(), "%m%d") < DATE_FORMAT(l.tanggal_menikah, "%m%d")) AS usia'),
                    DB::raw("DATE_PART('YEAR', current_date) - DATE_PART('YEAR',l.tanggal_menikah)  AS usia"),
                    'l.id_unit',
                    'u.nama_unit',
                    'l.alamat']
            )
            ->join('jemaat as p', 'l.no_kk', '=', 'p.no_kk')
            ->where('l.status_keluarga', 'Kepala keluarga')
            ->where('p.status_keluarga', 'Istri')
            ->join('unit as u', 'l.id_unit', '=', 'u.id');

        if ($idUnit != null) {
            $query = $query->where('l.id_unit', '=', $idUnit);
        }
                                                        # 20/10/1985, INTERVAL 2023 - 1985 YEAR
        // $query = $query->whereBetween(DB::raw("(l.tanggal_menikah + DATE_PART('YEAR', current_date) - DATE_PART('YEAR',l.tanggal_menikah) * INTERVAL '1 year')"), [now(), now()->addDays(50)]);
        $query = $query->whereBetween(DB::raw("DATE_ADD(l.tanggal_menikah, INTERVAL DATE_PART('YEAR', current_date) - DATE_PART('YEAR',l.tanggal_menikah) YEAR)"), [now(), now()->addDays(50)]);
        $query = $query->orderByRaw('MONTH(l.tanggal_menikah) ASC, DAY(l.tanggal_menikah) ASC');
        if($limit != null)
        {
            $query = $query->limit($limit);
        }
        return $query->get();
    }

    public function getKelahiran($awal, $akhir, ?int $idUnit, ?int $limit = null): \Illuminate\Support\Collection
    {
        $query = DB::table('jemaat')
            ->select(
                ['jemaat.id', 'nama_lengkap', 'tanggal_lahir',
                DB::raw("DATE_PART('YEAR', current_date) - DATE_PART('YEAR',tanggal_lahir)  AS usia"),
                // DB::raw('YEAR(CURDATE()) - YEAR(tanggal_lahir)  AS usia'),
                'id_unit', 'u.nama_unit', 'alamat']
            )->join('unit as u', 'id_unit', '=', 'u.id');

        // $query = $query->whereBetween('l.tanggal_lahir', [$awal, $akhir]);

        // $query = $query->whereBetween(DB::raw("tanggal_lahir + INTERVAL 'DATE_PART('YEAR', current_date) - DATE_PART('YEAR', tanggal_lahir) year'"), [now(), now()->addDays(50)]);
        $query = $query->whereBetween(DB::raw('DATE_ADD(tanggal_lahir, INTERVAL YEAR(CURDATE()) - YEAR(tanggal_lahir) YEAR)'), [now(), now()->addDays(50)]);


        if ($idUnit != null) {
            $query = $query->where('id_unit', '=', $idUnit);
        }
        $query = $query->orderByRaw('MONTH(tanggal_lahir) ASC, DAY(tanggal_lahir) ASC');
        if($limit != null)
        {
            $query = $query->limit($limit);
        }
        return $query->get();
    }
}

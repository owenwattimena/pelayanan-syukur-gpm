<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\KelahiranService;
use App\Services\PushNotificationService;
use App\Services\UnitService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelahiranController extends Controller
{
    public KelahiranService $kelahiranService;
    public UnitService $unitService;
    public PushNotificationService $pushNotifService;
    public function __construct(KelahiranService $kelahiranService, UnitService $unitService, PushNotificationService $pushNotifService)
    {
        $this->kelahiranService = $kelahiranService;
        $this->unitService = $unitService;
        $this->pushNotifService = $pushNotifService;
    }
    public function index(Request $request)
    {
        $date = Carbon::now();
        $data['month'] = $date->month;
        if($request->query('month'))
        {
            $data['month'] = $request->query('month');
        }
        // $data['kelahiran'] = $this->kelahiranService->getBySektor(Auth::guard('admin')->user()->sektor->first()->id);
        $data['unit'] = $this->unitService->get(Auth::guard('admin')->user()->sektor->first()->id);
        $query = DB::table('jemaat')->select(['nama_lengkap', 'tanggal_lahir', 'id_unit', 'u.nama_unit', 'alamat'])
            ->join('unit as u', 'id_unit', '=', 'u.id');

        $query = $query->whereMonth('tanggal_lahir', $data['month']);

        $data['kelahiran'] = $query->orderBy('tanggal_lahir')->get();
        return view('pelayanan-kelahiran.index', $data);
    }
    public function tambah(Request $request)
    {
        $data = $request->validate([
            "nama" => "required",
            "tanggal" => "required",
            "jam" => "required",
            "alamat" => "required",
            "id_unit" => "required",
        ]);
        $data['tipe'] = "kelahiran";
        // dd($request->all());

        $unit = $this->unitService->getById($request->id_unit);

        $currentDate = new \DateTime();
        $targetDate = new \DateTime("$request->tanggal $request->jam");
        $interval = $currentDate->diff($targetDate);

        $waktu = 0;
        $satuan = 'hari';

        if($interval->y > 0)
        {
            $waktu = $interval->y;
            $satuan = 'Tahun';
        }
        elseif($interval->m > 0)
        {
            $waktu = $interval->m;
            $satuan = 'Bulan';
        }
        elseif($interval->d > 0)
        {
            $waktu = $interval->d;
            $satuan = 'Hari';
        }
        elseif($interval->h > 0)
        {
            $waktu = $interval->h;
            $satuan = 'Jam';
        }
        elseif($interval->i > 0)
        {
            $waktu = $interval->i;
            $satuan = 'Menit';
        }
        elseif($interval->s > 0)
        {
            $waktu = $interval->s;
            $satuan = 'Detik';
        }

        $notif = [
            "title" => "Ibadah Pelayanan Ulang Tahun Kelahiran",
            "body" => "Ibadah Pelayanan Ulang Tahun Kelahiran $request->nama pada $request->tanggal pukul $request->jam $unit->nama_unit di $request->alamat akan dimulai $waktu $satuan lagi."
        ];
        $this->pushNotifService->pushNotification($notif, $data,  $unit->id);
        try {
            if ($this->kelahiranService->tambah($data)) {
                return redirect()->back()->with(AlertFormatter::success("Data kelahiran berhasil ditambahkan"));
            }
            return redirect()->back()->with(AlertFormatter::danger("Data kelahiran gagal ditambahkan"));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Data kelahiran gagal ditambahkan. " . $e->getMessage()));
        }
    }
}

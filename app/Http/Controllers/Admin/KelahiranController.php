<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\KelahiranService;
use App\Services\PushNotificationService;
use App\Services\UnitService;
use Illuminate\Http\Request;

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
    public function index()
    {
        $data['kelahiran'] = $this->kelahiranService->getBySektor(\Auth::guard('admin')->user()->sektor->first()->id);
        $data['unit'] = $this->unitService->get(\Auth::guard('admin')->user()->sektor->first()->id);
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

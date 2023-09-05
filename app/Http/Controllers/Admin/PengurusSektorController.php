<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\SektorService;
use Illuminate\Http\Request;

class PengurusSektorController extends Controller
{

    private SektorService $sektorService;
    private AdminService $adminService;
    public function __construct(SektorService $sektorService, AdminService $adminService)
    {
        $this->adminService = $adminService;
        $this->sektorService = $sektorService;
    }

    public function index()
    {
        $data['sektor'] = $this->sektorService->get();
        $data['pengurus'] = $this->sektorService->getPengurus();
        return view('pengurus-sektor.index', $data);
    }

    public function prosesTambah(Request $request)
    {
        $data = $request->validate([
            "nama_lengkap" => "required",
            "email" => "required|unique:admin,email",
            "telepon" => "required",
            "sektor" => "required",
            "username" => "required",
            "password" => "required",
        ]);

        try {
            if($this->adminService->daftar($data))
            {
                return redirect()->back()->with(AlertFormatter::success("Pengurus sektor berhasil ditambahkan. "));
            }
            return redirect()->back()->with(AlertFormatter::danger("Pengurus sektor gagal ditambahkan."));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Pengurus sektor gagal ditambahkan. " . $e->getMessage()));
        }
    }

    public function prosesUbah(Request $request, int $idPengurusSektor)
    {
        $data = $request->validate([
            "nama_lengkap" => "required",
            "email" => "required|email",
            "telepon" => "required",
            "sektor" => "required",
            "username" => "required",
        ]);


        try {
            if($this->sektorService->ubahPengurus($data,$idPengurusSektor))
            {
                return redirect()->back()->with(AlertFormatter::success("Pengurus sektor berhasil diubah. "));
            }
            return redirect()->back()->with(AlertFormatter::danger("Pengurus sektor gagal diubah."));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Pengurus sektor gagal diubah. " . $e->getMessage()));
        }
    }

    public function prosesHapus(Request $request, int $idPengurusSektor)
    {
        try {
            if($this->sektorService->hapusPengurus($idPengurusSektor))
            {
                return redirect()->back()->with(AlertFormatter::success("Pengurus sektor berhasil dihapus. "));
            }
            return redirect()->back()->with(AlertFormatter::danger("Pengurus sektor gagal dihapus. "));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Pengurus sektor gagal dihapus. " . $e->getMessage()));
        }
    }
}

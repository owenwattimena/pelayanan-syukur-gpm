<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\SektorService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AdminService $adminService;
    private SektorService $sektorService;

    public function __construct(AdminService $adminService, SektorService $sektorService)
    {
        $this->adminService = $adminService;
        $this->sektorService = $sektorService;
    }

    public function masuk()
    {
        // dd(file_get_contents(storage_path('oauth-private.key')));
        return view('auth.masuk');
    }

    public function prosesMasuk(Request $request)
    {
        $credentials  = $request->validate([
            "username" => "required",
            "password" => "required",
        ]);

        try {
            if(\Auth::guard('admin')->attempt($credentials))
            {
                return redirect()->route('home');
            }
            return redirect()->back()->with(AlertFormatter::danger("Gagal Masuk. Username atau password tidak sesuai."));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Gagal Masuk. " . $e->getMessage()));
        }
    }

    public function daftar()
    {
        $data['sektor'] = $this->sektorService->get();
        return view('auth.daftar', $data);
    }

    public function prosesDaftar(Request $request)
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
                return redirect()->back()->with(AlertFormatter::success("Pendaftaran berhasil. "));
            }
            return redirect()->back()->with(AlertFormatter::danger("Pendaftaran gagal. Pastikan data yang anda masukan sudah benar."));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Pendaftaran gagal. " . $e->getMessage()));
        }
    }
}

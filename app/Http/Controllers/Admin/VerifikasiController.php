<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data['users'] = $this->userService->get();
        return view('verifikasi.index', $data);
    }

    public function terima(Request $request)
    {
        $data = $request->validate(['id' => 'required']);
        try {
            if($this->userService->verifikasi($data['id']))
            {
                return redirect()->back()->with(AlertFormatter::success("Data berhasil diverifikasi."));
            }
            return redirect()->back()->with(AlertFormatter::danger("Data gagal diverifikasi."));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Data gagal diverifikasi. " . $e->getMessage()));
        }
    }

    public function tolak(Request $request)
    {
        $data = $request->validate(['id' => 'required']);
        try {
            if($this->userService->delete($data['id']))
            {
                return redirect()->back()->with(AlertFormatter::success("Data berhasil ditolak."));
            }
            return redirect()->back()->with(AlertFormatter::danger("Data gagal ditolak."));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Data gagal ditolak. " . $e->getMessage()));
        }
    }
}

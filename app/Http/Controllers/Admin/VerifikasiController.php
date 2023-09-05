<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\UnitService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{

    private UserService $userService;
    private UnitService $unitService;

    public function __construct(UserService $userService, UnitService $unitService)
    {
        $this->userService = $userService;
        $this->unitService = $unitService;
    }

    public function index()
    {
        $data['users'] = $this->userService->get();
        $data['unit'] = $this->unitService->get(\Auth::guard('admin')->user()->sektor->first()->id);
        return view('verifikasi.index', $data);
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            "nama_lengkap" => "required",
            "email" => "required",
            "telepon" => "required",
            "id_unit" => "required",
            "username" => "required",
            "password" => "required"
        ]);

        $data['email_verified_at'] = Carbon::now();

        try {
            if ($this->userService->tambah($data)) {
                return redirect()->back()->with(AlertFormatter::success("Pengurus unit berhasil ditambah"));
            }
            return redirect()->back()->with(AlertFormatter::danger("Pengurus unit gagal ditambah"));

        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->getCode();

            if ($errorCode == 23000) {
                // Get the error message from the exception
                $errorMessage = $e->getMessage();

                // Extract the column name(s) from the error message
                preg_match('/Duplicate entry \'(.+?)\' for key/', $errorMessage, $matches);

                if (isset($matches[1])) {
                    $duplicateColumn = $matches[1];
                    // Handle the "Duplicate entry" error with the specific column name(s)
                    // For example, you can display a user-friendly error message with the column name(s)
                    return redirect()->back()->with(AlertFormatter::danger("Data '$duplicateColumn' telah digunakan."));
                }
            }
            return redirect()->back()->with(AlertFormatter::danger("Pengurus unit gagal ditambah. " . $e->getMessage()));
        }

    }

    public function ubah(Request $request, $id)
    {
        $data = $request->validate([
            "nama_lengkap" => "required",
            "email" => "required",
            "telepon" => "required",
            "id_unit" => "required",
            "username" => "required",
        ]);

        try {
            if ($this->userService->ubah($data, $id)) {
                return redirect()->back()->with(AlertFormatter::success("Pengurus unit berhasil diubah"));
            }
            return redirect()->back()->with(AlertFormatter::danger("Pengurus unit gagal diubah"));

        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->getCode();

            if ($errorCode == 23000) {
                // Get the error message from the exception
                $errorMessage = $e->getMessage();

                // Extract the column name(s) from the error message
                preg_match('/Duplicate entry \'(.+?)\' for key/', $errorMessage, $matches);

                if (isset($matches[1])) {
                    $duplicateColumn = $matches[1];
                    // Handle the "Duplicate entry" error with the specific column name(s)
                    // For example, you can display a user-friendly error message with the column name(s)
                    return redirect()->back()->with(AlertFormatter::danger("Data '$duplicateColumn' telah digunakan."));
                }
            }
            return redirect()->back()->with(AlertFormatter::danger("Pengurus unit gagal diubah. " . $e->getMessage()));
        }
    }

    public function terima(Request $request)
    {
        $data = $request->validate(['id' => 'required']);
        try {
            if ($this->userService->verifikasi($data['id'])) {
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
            if ($this->userService->delete($data['id'])) {
                return redirect()->back()->with(AlertFormatter::success("Data berhasil ditolak."));
            }
            return redirect()->back()->with(AlertFormatter::danger("Data gagal ditolak."));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Data gagal ditolak. " . $e->getMessage()));
        }
    }

    public function hapus(Request $request, $idUser)
    {
        try {
            if ($this->userService->delete($idUser)) {
                return redirect()->back()->with(AlertFormatter::success("Pengurus Unit berhasil dihapus."));
            }
            return redirect()->back()->with(AlertFormatter::danger("Pengurus Unit gagal dihapus."));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Pengurus Unit gagal dihapus. " . $e->getMessage()));
        }
    }
}

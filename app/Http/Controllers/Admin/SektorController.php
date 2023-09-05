<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Services\SektorService;
use Illuminate\Http\Request;

class SektorController extends Controller
{
    private SektorService $sektorService;
    public function __construct(SektorService $sektorService)
    {
        $this->sektorService = $sektorService;
    }
    public function index()
    {
        $data['sektor'] = $this->sektorService->get();
        return view('sektor.index', $data);
    }

    public function prosesTambah(Request $request)
    {
        $data = $request->validate([
            'nama_sektor' => 'required'
        ]);

        try {
            if($this->sektorService->tambah($data))
            {
                return redirect()->back()->with(AlertFormatter::success('Sektor berhasil ditambahkan'));
            }
            return redirect()->back()->with(AlertFormatter::danger('Sektor gagal ditambahkan'));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger('Sektor gagal ditambahkan. ' . $e->getMessage()));
        }
    }

    public function prosesUbah(Request $request, $id)
    {
        $data = $request->validate([
            'nama_sektor' => 'required'
        ]);

        try {
            if($this->sektorService->ubah($data, $id))
            {
                return redirect()->back()->with(AlertFormatter::success('Sektor berhasil diubah'));
            }
            return redirect()->back()->with(AlertFormatter::danger('Sektor gagal diubah'));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger('Sektor gagal diubah. ' . $e->getMessage()));
        }
    }
    public function prosesHapus(Request $request, $id)
    {

        try {
            if($this->sektorService->hapus($id))
            {
                return redirect()->back()->with(AlertFormatter::success('Sektor berhasil hapus'));
            }
            return redirect()->back()->with(AlertFormatter::danger('Sektor gagal hapus'));
        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger('Sektor gagal hapus. ' . $e->getMessage()));
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AlertFormatter;
use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $data['pengaturan'] = Pengaturan::all()->first();
        return view('pengaturan.index', $data);
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'nama_jemaat' => 'required'
        ]);

        try {

            $pengaturan = Pengaturan::all();
            if ($pengaturan->count() > 0) {
                $pengaturan = $pengaturan->first();
            } else {
                $pengaturan = new Pengaturan;
            }
            $pengaturan->nama_jemaat = $data['nama_jemaat'];
            $pengaturan->waktu_notifikasi = $request->waktu_notifikasi;
            $pengaturan->durasi_notifikasi = $request->durasi_notifikasi;
            if ($pengaturan->save()) {
                return redirect()->back()->with(AlertFormatter::success("Pengaturan berhasil disimpan"));
            }
            return redirect()->back()->with(AlertFormatter::danger("Pengaturan gagal disimpan"));

        } catch (\Exception $e) {
            return redirect()->back()->with(AlertFormatter::danger("Pengaturan gagal disimpan. " . $e->getMessage()));
        }
    }
}

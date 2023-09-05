<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\JsonFormatter;
use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Services\PushNotificationService;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    private PushNotificationService $pushNotifService;
    public function __construct(PushNotificationService $pushNotifService)
    {
        $this->pushNotifService = $pushNotifService;
    }
    public function updateFcmToken(Request $request)
    {

        try {
            // $this->pushNotifService->updateFcmToken(['fcm_token' => $request->token]);
            $user = $request->user();
            $user->fcm_token = $request->fcm_token;
            if ($user->save()) {
                return JsonFormatter::success([
                    'fcm_token' => $request->fcm_token
                ], message: 'FCM Token berhasil disimpan.');
            }
            return JsonFormatter::error('FCM Token gagal disimpan.');
        } catch (\Exception $e) {
            return JsonFormatter::error('FCM Token gagal disimpan.');
        }
    }

    public function saveNotifikasi(Request $request)
    {
        $data = \Validator::make($request->all(), [
            'judul' => 'required',
            'isi' => 'required',
            // 'waktu' => 'required',
            // 'satuan_waktu' => 'required',
            'id_unit' => 'required',
        ]);

        try {
            $notifikasi = Notifikasi::
                // where('judul', $request->judul)
                where('isi', $request->isi)
                // ->where('waktu', $request->waktu)
                // ->where('satuan_waktu', $request->satuan_waktu)
                ->where('id_unit', $request->id_unit)
                ->get();
            if (count($notifikasi) <= 0) {
                $result = Notifikasi::create($data->getData());
                if ($result)
                    return JsonFormatter::success($result, message: 'Berhasil menyimpan notifikasi');
                return JsonFormatter::error('Gagal menyimpan notifikasi');
            }
            return JsonFormatter::error('Notifikasi sudah tersimpan');

        } catch (\Exception $e) {
            return JsonFormatter::error('Gagal menyimpan notifikasi. ' . $e->getMessage());
        }

    }
}

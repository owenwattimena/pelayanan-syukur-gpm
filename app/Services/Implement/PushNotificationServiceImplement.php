<?php
namespace App\Services\Implement;

use App\Helpers\FirebaseCloudMessaging;
use App\Models\Admin;
use App\Models\User;
use App\Repositories\KelahiranRepository;
use App\Repositories\NotifikasiRepository;
use App\Repositories\PernikahanRepository;
use App\Services\PushNotificationService;

class PushNotificationServiceImplement implements PushNotificationService
{
    private string $url = 'https://fcm.googleapis.com/fcm/send';
    private string $serverKey = "AAAA1iml1XM:APA91bFboFI-dE1cw_KWfP4LIESyL7dJh2IDzar7IOlMS9zJWeokMsZcpcwYehyarQsI8Y26MCFs0vaUlfP1qP4NPJtwOkEI0nSQ1Gha5LnxHPklpmPfMP5zv9ZLhhzAMVXFwg5s2v4V";


    private PernikahanRepository $pernikahanRepo;
    private KelahiranRepository $kelahiranRepo;
    private NotifikasiRepository $notifRepo;

    public function __construct(PernikahanRepository $pernikahanRepo, KelahiranRepository $kelahiranRepo, NotifikasiRepository $notifRepo)
    {
        $this->pernikahanRepo = $pernikahanRepo;
        $this->kelahiranRepo = $kelahiranRepo;
        $this->notifRepo = $notifRepo;
    }

    public function updateFcmToken(array $data): bool
    {
        return \Auth::user()->update($data);
    }
    public function pushNotification(array $notif, array $data, int $idUnit): bool
    {
        // $fcmToken = User::with(['unit'])->whereNotNull('fcm_token')->pluck('fcm_token')->all();
        $fcmToken = User::whereHas('unit', function ($query) use ($idUnit) {
            return $query->where('unit.id', $idUnit);
        })->whereNotNull('fcm_token')->pluck('fcm_token')->all();


        $notifData = [
            "registration_ids" => $fcmToken,
            "notification" => $notif,
            "data" => $data
        ];
        $encodedData = json_encode($notifData);

        $headers = [
            'Authorization:key=' . $this->serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        dd($result);
        return false;
    }

    public function pushNotificationPernikahan(?int $day = 0)
    {
        $data = $this->pernikahanRepo->getTheDay($day);
        if ($data->count() > 0) {
            $judul = "Ibadah Pelayanan Ulang Tahun Pernikahan";
            $notif["title"] = $judul;
            $dataNotif['judul'] = $judul;
            foreach ($data as $key => $value) {
                $idUnit = $value->id_unit;
                $fcmTokens = User::whereHas('unit', function ($query) use ($idUnit) {
                    return $query->where('unit.id', $idUnit);
                })->whereNotNull('fcm_token')->pluck('fcm_token')->all();
                $isi = "Ibadah Pelayanan Ulang Tahun Pernikahan ke-$value->usia Thn, pasangan $value->suami & $value->istri pada $value->tanggal_menikah, $value->nama_unit di $value->alamat akan dimulai $day hari lagi.";
                $notif["body"] = $isi;
                $dataNotif['isi'] = $isi;
                $dataNotif['id_unit'] = $idUnit;

                FirebaseCloudMessaging::send($fcmTokens, $notif);
                $this->notifRepo->save($dataNotif);
            }
        }


    }
    public function pushNotificationKelahiran(?int $day = 0)
    {
        $data = $this->kelahiranRepo->getTheDay($day);
        if ($data->count() > 0) {
            $judul = "Ibadah Pelayanan Ulang Tahun Kelahiran";
            $notif["title"] = $judul;
            $notifData['judul'] = $judul;
            foreach ($data as $key => $value) {
                $idUnit = $value->id_unit;
                $fcmTokens = User::whereHas('unit', function ($query) use ($idUnit) {
                    return $query->where('unit.id', $idUnit);
                })->whereNotNull('fcm_token')->pluck('fcm_token')->all();
                $isi = "Ibadah Pelayanan Ulang Tahun Kelahiran ke-$value->usia Thn, $value->nama_lengkap pada $value->tanggal_lahir, $value->nama_unit di $value->alamat akan dimulai $day hari lagi.";
                $notif["body"] = $isi;
                $notifData['isi'] = $isi;
                $notifData['id_unit'] = $idUnit;

                FirebaseCloudMessaging::send($fcmTokens, $notif);
                $this->notifRepo->save($notifData);

            }
        }
    }
}

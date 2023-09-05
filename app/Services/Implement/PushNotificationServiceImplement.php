<?php
namespace App\Services\Implement;

use App\Models\Admin;
use App\Models\User;
use App\Services\PushNotificationService;

class PushNotificationServiceImplement implements PushNotificationService
{
    public function updateFcmToken(array $data): bool
    {
        return \Auth::user()->update($data);
    }
    public function pushNotification(array $notif, array $data, int $idUnit): bool
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        // $fcmToken = User::with(['unit'])->whereNotNull('fcm_token')->pluck('fcm_token')->all();
        $fcmToken = User::whereHas('unit', function($query) use ($idUnit){
            return $query->where('unit.id', $idUnit);
        })->whereNotNull('fcm_token')->pluck('fcm_token')->all();

        $serverKey = "AAAA1iml1XM:APA91bFboFI-dE1cw_KWfP4LIESyL7dJh2IDzar7IOlMS9zJWeokMsZcpcwYehyarQsI8Y26MCFs0vaUlfP1qP4NPJtwOkEI0nSQ1Gha5LnxHPklpmPfMP5zv9ZLhhzAMVXFwg5s2v4V";

        $notifData = [
            "registration_ids" => $fcmToken,
            "notification" => $notif,
            "data" => $data
        ];
        $encodedData = json_encode($notifData);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
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
}

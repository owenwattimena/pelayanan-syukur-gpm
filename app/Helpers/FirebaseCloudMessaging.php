<?php

namespace App\Helpers;

class FirebaseCloudMessaging
{
    private static String $url = 'https://fcm.googleapis.com/fcm/send';
    private static String $serverKey = "AAAA1iml1XM:APA91bFboFI-dE1cw_KWfP4LIESyL7dJh2IDzar7IOlMS9zJWeokMsZcpcwYehyarQsI8Y26MCFs0vaUlfP1qP4NPJtwOkEI0nSQ1Gha5LnxHPklpmPfMP5zv9ZLhhzAMVXFwg5s2v4V";

    public static function send(array $fmcTokens, array $notification) : bool
    {
        $notifData = [
            "registration_ids" => $fmcTokens,
            "notification" => $notification,
        ];
        $encodedData = json_encode($notifData);

        $headers = [
            'Authorization:key=' . self::$serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::$url);
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
            // return false;
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        return false;
    }
}

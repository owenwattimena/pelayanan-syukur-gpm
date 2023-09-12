<?php
namespace App\Services;

interface PushNotificationService
{
    public function updateFcmToken(array $data) : bool;
    public function pushNotification(array $notif, array $data, int $idUnit) : bool;

    public function pushNotificationPernikahan(?int $day = 0);
    public function pushNotificationKelahiran(?int $day = 0);
}

<?php

namespace App\Console\Commands;

use App\Models\Pengaturan;
use App\Services\PushNotificationService;
use Illuminate\Console\Command;

class SendNotification extends Command
{

    private PushNotificationService $pushNotifService;

    public function __construct(PushNotificationService $pushNotifService)
    {
        parent::__construct();
        $this->pushNotifService = $pushNotifService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perintah untuk mengirimkan notifikasi';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $pengaturan = Pengaturan::get()->first();
        $arr = explode(",", $pengaturan->durasi_notifikasi);
        foreach ($arr as $key => $value) {
            $this->pushNotifService->pushNotificationKelahiran($value); // push notif 7 hari lagi kelahiran
            $this->pushNotifService->pushNotificationPernikahan($value);
        }

        // $this->pushNotifService->pushNotificationKelahiran(7); // push notif 7 hari lagi kelahiran
        // $this->pushNotifService->pushNotificationPernikahan(7);  // push notif 7 hari lagi pernikahan

        // $this->pushNotifService->pushNotificationKelahiran(3); // push notif 3 hari lagi kelahiran
        // $this->pushNotifService->pushNotificationPernikahan(3);  // push notif 3 hari lagi pernikahan

        // $this->pushNotifService->pushNotificationKelahiran(1); // push notif 1 hari lagi kelahiran
        // $this->pushNotifService->pushNotificationPernikahan(1);  // push notif 1 hari lagi pernikahan

        return Command::SUCCESS;
    }
}

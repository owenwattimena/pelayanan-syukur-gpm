<?php

namespace App\Console\Commands;

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
        $this->pushNotifService->pushNotificationPernikahan(38);

        return Command::SUCCESS;
    }
}

<?php

namespace App\Listeners;

use App\Events\AdminActivityLogged;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySuperAdmin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AdminActivityLogged $event): void
    {
        $superAdminEmail = 'superadmin@domain.com';

        $user_id = $event->userId;
        $action = $event->action;
        $description = $event->description;

        $message = "Actifity Log, user dengan ID {$user_id} melakukan aksi: {$action}. {$description}";

        Mail::raw($message, function ($mail) use ($superAdminEmail) {
            $mail->to($superAdminEmail)
                 ->subject('Notifikasi Aktivitas Admin');
        });

    }
}

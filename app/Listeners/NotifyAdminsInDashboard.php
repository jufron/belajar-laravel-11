<?php

namespace App\Listeners;

use App\Events\AdminActivityLogged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminsInDashboard
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
        // Broadcast::channel('admin-notifications')->broadcast([
        //     'message' => "Admin ID {$event->userId} melakukan aksi: {$event->action}",
        // ]);
    }
}

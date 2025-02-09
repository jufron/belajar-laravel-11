<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use App\Events\AdminActivityLogged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreAdminActivity
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
        ActivityLog::create([
            'user_id'    => $event->userId,
            'action'     => $event->action,
            'description' => $event->description,
        ]);
    }
}

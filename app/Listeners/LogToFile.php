<?php

namespace App\Listeners;

use Throwable;
use App\Events\AdminActivityLogged;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogToFile
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
        Log::channel('activity')->info("Admin ID {$event->userId} melakukan aksi: {$event->action}");
    }

    /**
     * Determine the time at which the listener should timeout.
     */
    // public function retryUntil(): DateTime
    // {
    //     return now()->addMinutes(10);
    // }

    public function failed (AdminActivityLogged $event, Throwable $exception) : void
    {
        Log::error('Failed to log activity');
    }
}

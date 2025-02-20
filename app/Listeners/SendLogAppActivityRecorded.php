<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use App\Events\LogAppActivityRecorded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLogAppActivityRecorded implements ShouldQueue
{
    use InteractsWithQueue;

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
    public function handle(LogAppActivityRecorded $event): void
    {
        Log::info("create logging activity log : $event->user->name, $event->action");
    }
}

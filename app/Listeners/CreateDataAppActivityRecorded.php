<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use App\Events\DataAppActivityRecorded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDataAppActivityRecorded implements ShouldQueue
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
    public function handle(DataAppActivityRecorded $event): void
    {
        Log::info("insert activity log database : $event->user->name, $event->action");
    }
}

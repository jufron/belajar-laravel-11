<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use App\Events\EmailAppActivityRecorded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailAppActivityRecorded implements ShouldQueue
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
    public function handle(EmailAppActivityRecorded $event): void
    {
        Log::info("Send email activity log : $event->user->name, $event->action");
    }
}

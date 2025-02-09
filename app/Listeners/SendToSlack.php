<?php

namespace App\Listeners;

use App\Events\AdminActivityLogged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class SendToSlack
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
        $webhookUrl = config('services.slack.webhook');

        Http::post($webhookUrl, [
            'text' => "🚨 *Admin Alert* 🚨\nAdmin ID: {$event->userId} melakukan aksi: *{$event->action}*.",
        ]);
    }
}

<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotification implements ShouldQueue
{
    use Queueable;

    public $tries = 5;
    public $maxExceptions = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $productID
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("Sending notification for podcast ID: " . $this->productID);
        sleep(1);
    }
}

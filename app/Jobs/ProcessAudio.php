<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessAudio implements ShouldQueue
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
        Log::info('processing audio podcast id' . $this->productID);
        sleep(3);
    }
}

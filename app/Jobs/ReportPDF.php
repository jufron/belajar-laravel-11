<?php

namespace App\Jobs;

use DateTime;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportPDF implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('create report PDF with log');
        Log::info('create report PDF with log');
        Log::info('create report PDF with log');
        Log::info('create report PDF with log');
        Log::info('create report PDF with log');
    }

    /**
     * Determine the time at which the job should timeout.
    */
    public function retryUntil() : DateTime
    {
        return now()->addMinutes(1);
    }

    /**
     * Handle a job failure.
    */
    public function failed(?Throwable $exception): void
    {
        Log::error(
            "Error job report excel: " . $exception->getMessage() .
            ". Code: " . $exception->getCode() .
            ". File: " . $exception->getFile() .
            ". Line: " . $exception->getLine() .
            ". Trace: " . $exception->getTraceAsString()
        );
    }
}

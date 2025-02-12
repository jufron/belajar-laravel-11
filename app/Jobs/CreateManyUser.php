<?php

namespace App\Jobs;

use DateTime;
use Throwable;
use App\Models\User;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Log;

class CreateManyUser implements ShouldQueue, ShouldBeUnique
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
    public function __construct(
        public $user
    )
    {
        //
    }

    /**
     * Determine the time at which the job should timeout.
     */
    public function retryUntil() : DateTime
    {
        return now()->addMinutes(1);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('generate user with log');
        Log::info('generate user with log');
        Log::info('generate user with log');
        Log::info('generate user with log');
        Log::info('generate user with log');
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

    /**
     * Get the unique ID for the job.
    */
    public function uniqueId(): string
    {
        return $this->user->id;
    }
}

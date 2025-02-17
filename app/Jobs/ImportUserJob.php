<?php

namespace App\Jobs;

use Throwable;
use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;

class ImportUserJob implements ShouldQueue, ShouldBeUniqueUntilProcessing, ShouldBeEncrypted
{
    use Queueable, Batchable;

    public $tries = 5;
    public $maxExceptions = 3;


    /**
     * Create a new job instance.
     */
    public function __construct(
        protected array $userData)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::create([
            'name'  => $this->userData['name'],
            'email' => $this->userData['email'],
            'password' => bcrypt('password123'), // Default password
        ]);
    }

    public function failed(?Throwable $exception): void
    {
        Log::info('job Failed to import user: ' . $exception->getMessage());
    }
}

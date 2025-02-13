<?php

namespace App\Jobs;

use App\Jobs\Middleware\LimitRunningJob;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;

class UpdateProductPrice implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $productID,
        public float $newPrice
    )
    {
        $this->onQueue('processing');
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [
            new LimitRunningJob(),
            // (new LimitRunningJob())->releaseAfter(60),
        ];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //  Simulasi update harga produk di database
        Log::info("Memperbarui harga produk {$this->productID} ke Rp {$this->newPrice}");
        sleep(5); // Simulasi pemrosesan lambat
        Log::info("Selesai memperbarui harga produk {$this->productID}");
    }

    /**
     * Handle a job failure.
    */
    public function failed(?Throwable $exception): void
    {
        Log::error(
            "Error job update product price: " . $exception->getMessage() .
            ". Code: " . $exception->getCode() .
            ". File: " . $exception->getFile() .
            ". Line: " . $exception->getLine() .
            ". Trace: " . $exception->getTraceAsString()
        );
    }

    public function uniqueId(): string
    {
        return "product-price-{$this->productID}";
    }
}

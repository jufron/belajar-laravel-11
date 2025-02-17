<?php

namespace App\Http\Controllers;

use Throwable;
use App\Jobs\ProcessAudio;
use App\Jobs\StoreMetadata;
use Illuminate\Http\Request;
use App\Jobs\SendNotification;
use App\Jobs\GenerateThumbnail;
use App\Jobs\UpdateProductPrice;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Batch;

class ProductController extends Controller
{
    public function updatePrice ()
    {
        $productID = '123';
        $newPrice = '15000';

        UpdateProductPrice::dispatchAfterResponse($productID,$newPrice);
        return '<h1>Update Harga Sedang Diproses</h1>';
    }

    public function store ()
    {
        $productID = '123';

        Bus::chain([
            new ProcessAudio($productID),
            new GenerateThumbnail($productID),
            new StoreMetadata($productID),
            new SendNotification($productID)
        ])
        // ->before(function (Batch $batch) {
        //     Log::info('Job chaining dimulai prosess');
        // })
        ->after(function (Batch $batch) {
            Log::info('Job chaining selesai prosess');
        })
        ->progress(function (Batch $batch) {
            $batch->id;
            $batch->name;
            $batch->totalJobs;
            $batch->pendingJobs;
            $batch->failedJobs;
            $batch->processedJobs();
            $batch->progress();
            $batch->finished();
            $batch->cancel();
            $batch->cancelled();
            Log::info('Job chaining sedang berjalan: ' . $batch->progress());
        })
        ->then(function (Batch $batch) {
            Log::info('Job chaining seluruhnya berhasil berhasil');
        })
        ->catch( function (Throwable $e) {
            Log::error('Job chaining gagal: ' . $e->getMessage());
        })
        ->finally(function (Batch $batch) {
            Log::info('Job chaining selesai');
        })
        ->dispatch();

        return '<h1>Sedang Memproses</h1>';
    }
}

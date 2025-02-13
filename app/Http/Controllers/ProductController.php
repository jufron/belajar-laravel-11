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
        ->catch( function (Throwable $e) {
            Log::error('Job chaining gagal: ' . $e->getMessage());
        })
        ->dispatch();
    }
}

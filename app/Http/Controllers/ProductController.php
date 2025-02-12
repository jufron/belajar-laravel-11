<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateProductPrice;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function updatePrice ()
    {
        $productID = '123';
        $newPrice = '15000';

        UpdateProductPrice::dispatchAfterResponse($productID,$newPrice);
        return '<h1>Update Harga Sedang Diproses</h1>';
    }
}

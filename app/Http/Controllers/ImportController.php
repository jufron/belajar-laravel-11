<?php

namespace App\Http\Controllers;

use Illuminate\Bus\Batch;
use App\Jobs\ImportUserJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ImportController extends Controller
{
    public function test()
    {
        // return Storage::disk('public')->exists('user.csv')
        //     ? '<h1>File ada</h1>'
        //     : '<h1>File tidak ada</h1>';

        $file = Storage::disk('public')->get('user.csv');
        return $file;
    }

    public function index() : View
    {
        return view('import');
    }

    public function import () : JsonResponse
    {
        try {
            // Membaca file CSV
            $file = Storage::disk('public')->path('user.csv');

            $openFileCsv = fopen($file, 'r');

            $readGetHeader = fgetcsv($openFileCsv);

            $jobCSV = [];

            while ($row = fgetcsv($openFileCsv)) {
                $userData = array_combine($readGetHeader, $row);
                // result array_combine
                // [
                //     'nama' => 'Budi',
                //     'email' => 'budi@mail.com',
                //     'telepon' => '08123456789'
                // ]
                $jobCSV[] = new ImportUserJob($userData);
            }

            fclose($openFileCsv);

            // Membuat batch queue dengan method progress
            $batch = Bus::batch($jobCSV)
                ->progress(function (Batch $batch) {
                    Cache::put(
                        "batch_progress_$batch->id",
                        $batch->progress(),
                        now()->addMinutes(120)
                    );
                })
                ->then(function (Batch $batch) {
                    Cache::put(
                        "batch_status_$batch->id",
                        'completed',
                        now()->addMinutes(10)
                    );
                })
                ->finally(function (Batch $batch) {
                    Cache::put(
                        "batch_status_$batch->id",
                        'failed',
                        now()->addMinutes(10)
                    );
                })
                ->dispatch();

            return response()->json([
                'message' => 'Import started',
                'batch_id' => $batch->id
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function getProgress($id)
    {
        $progress = Cache::get("batch_progress_$id");
        $status = Cache::get("batch_status_$id");

        return response()->json([
            'progress' => $progress,
            'status' => $status
        ]);
    }
}

<?php

use App\Modules\DataIngestion\Jobs\ProcessIngestedData;
use App\Modules\DataIngestion\Services\FileDataSource;
use Illuminate\Support\Facades\Route;

Route::get('/ingest', function () {
    $filePath = storage_path('files/salary.json');

    if (file_exists($filePath)) {
        $source = new FileDataSource($filePath);
        ProcessIngestedData::dispatch($source);
        echo "Job Dispatched..." . PHP_EOL;
    } else {
        echo "The file does not exist." . PHP_EOL;
    }
});

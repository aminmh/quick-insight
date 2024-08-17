<?php

namespace App\Modules\DataIngestion\Listeners;

use App\Modules\DataIngestion\Events\DataIngested;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreIngestedData
{
    public function handle(DataIngested $event) {
        $data = $event->data;

        $filename = Str::random(10) . '_' . date('Y-m-d_H-i-s') . '.json';

        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

        Storage::disk('local')->put('ingested_data/' . $filename, $jsonData);
    }

}

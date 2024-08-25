<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\DataCollectorInterface;
use App\Modules\DataIngestion\Contracts\DataSourceInterface;

class SheetDataCollector implements DataCollectorInterface
{
    public function collectData(DataSourceInterface $source): array
    {
        $source->connect();
        $data = $source->readData();
        $source->disconnect();
        return $data;
    }
}

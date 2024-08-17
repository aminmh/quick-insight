<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\DataCollectorInterface;
use App\Modules\DataIngestion\Contracts\DataSourceInterface;

class BatchDataCollector implements DataCollectorInterface
{
    public function collectData(DataSourceInterface $source): string
    {
        $source->connect();
        $data = $source->readData();
        $source->disconnect();
        return $data;
    }
}

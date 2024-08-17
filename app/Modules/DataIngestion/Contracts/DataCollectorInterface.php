<?php

namespace App\Modules\DataIngestion\Contracts;

interface DataCollectorInterface
{
    public function collectData(DataSourceInterface $source): string;
}

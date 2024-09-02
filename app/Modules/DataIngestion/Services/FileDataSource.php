<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\DataSourceInterface;

class FileDataSource implements DataSourceInterface
{

    public function __construct()
    {
    }

    public function connect(): void
    {
    }

    public function disconnect(): void
    {
    }

    public function readData(): array
    {
        return [];
    }
}

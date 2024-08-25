<?php

namespace App\Modules\DataIngestion\Contracts;

interface DataSourceInterface
{
    public function connect(): void;
    public function disconnect(): void;
    public function readData(): array;
}

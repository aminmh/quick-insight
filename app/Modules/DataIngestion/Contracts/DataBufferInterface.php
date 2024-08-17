<?php

namespace App\Modules\DataIngestion\Contracts;

interface DataBufferInterface
{
    public function add(array $data): void;
    public function get(): ?array;
    public function isEmpty(): bool;
}

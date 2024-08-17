<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\DataBufferInterface;

class InMemoryBuffer implements DataBufferInterface
{
    private $buffer = [];

    public function add(array $data): void
    {
        $this->buffer[] = $data;
    }

    public function get(): ?array
    {
        return array_shift($this->buffer);
    }

    public function isEmpty(): bool
    {
        return empty($this->buffer);
    }
}

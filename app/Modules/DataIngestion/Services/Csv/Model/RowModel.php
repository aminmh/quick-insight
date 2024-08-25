<?php

namespace App\Modules\DataIngestion\Services\Csv\Model;

class RowModel implements \ArrayAccess
{
    public function __construct(public string $sheet, public int $number, public array $data)
    {
    }

    public function addCell(string $column, ?string $value): void
    {
        $this[$column] = $value;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->data[$offset]);
    }
}

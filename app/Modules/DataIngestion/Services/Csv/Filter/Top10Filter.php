<?php

namespace App\Modules\DataIngestion\Services\Csv\Filter;

use App\Modules\DataIngestion\Contracts\SheetFilterInterface;
use App\Modules\DataIngestion\Services\Csv\Enum\SheetFilterEnum;

readonly class Top10Filter implements SheetFilterInterface
{
    public const TYPE = SheetFilterEnum::TOP10;

    public function __construct(private array $schema)
    {
    }

    public function getColumn(): string
    {
        return $this->schema['column'];
    }

    public function getDirection()
    {
        return $this->schema['direction'];
    }

    public function getUnit()
    {
        return $this->schema['unit'];
    }

    public function getCount(): int
    {
        return $this->schema['count'];
    }

    public function apply()
    {
        // TODO: Implement apply() method.
    }
}

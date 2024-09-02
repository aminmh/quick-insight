<?php

namespace App\Modules\DataIngestion\Services\Csv\Filter;

use App\Modules\DataIngestion\Contracts\SheetFilterInterface;
use App\Modules\DataIngestion\Services\Csv\Enum\SheetFilterEnum;

readonly class SimpleFilter
{
    public const TYPE = SheetFilterEnum::SIMPLE;

    public function __construct(private array $schema)
    {
    }

    public function getColumn(): string
    {
        return $this->schema['column'];
    }

    public function getValue()
    {
        return $this->schema['value'];
    }
}

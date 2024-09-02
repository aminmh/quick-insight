<?php

namespace App\Modules\DataIngestion\Services\Csv\Filter;

use App\Modules\DataIngestion\Contracts\SheetFilterInterface;
use App\Modules\DataIngestion\Services\Csv\Enum\SheetFilterEnum;

readonly class DatetimeFilter implements SheetFilterInterface
{
    public const TYPE = SheetFilterEnum::DATETIME;

    public function __construct(private array $schema)
    {
    }

    public function getColumn(): string
    {
        return $this->schema['column'];
    }

    public function getValue(): array
    {
        return $this->schema['value'];
    }

    public function apply()
    {
        // TODO: Implement apply() method.
    }
}

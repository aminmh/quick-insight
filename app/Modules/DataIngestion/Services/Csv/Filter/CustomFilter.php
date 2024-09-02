<?php

namespace App\Modules\DataIngestion\Services\Csv\Filter;

use App\Modules\DataIngestion\Contracts\SheetFilterInterface;
use App\Modules\DataIngestion\Services\Csv\Enum\SheetFilterEnum;

readonly class CustomFilter implements SheetFilterInterface
{
    public const TYPE = SheetFilterEnum::CUSTOM;

    public function __construct(private array $schema)
    {
    }

    public function getColumn(): string
    {
        return $this->schema['column'];
    }

    public function getOperand(): string
    {
        return $this->schema['operand'];
    }

    public function getJoin(): string
    {
        return $this->schema['join'];
    }

    public function getValue(): int
    {
        return $this->schema['value'];
    }

    public function filter()
    {
        // TODO: Implement apply() method.
    }
}

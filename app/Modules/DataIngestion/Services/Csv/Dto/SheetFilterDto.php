<?php

namespace App\Modules\DataIngestion\Services\Csv\Dto;

use App\Modules\DataIngestion\Services\Csv\Enum\SheetFilterEnum;
use Illuminate\Support\Arr;

readonly class SheetFilterDto
{
    private function __construct(
        public SheetFilterEnum $type,
        public int|string      $sheet,
        public string          $range,
        public array           $schema,
    )
    {

    }

    public static function fromArray(array $payload, string $range): SheetFilterDto
    {
        return new self(
            SheetFilterEnum::tryFrom($payload['type']),
            $payload['sheet'],
            $range,
            Arr::except($payload, ['type', 'sheet'])
        );

    }
}

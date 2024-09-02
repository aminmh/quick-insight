<?php

namespace App\Modules\DataIngestion\Factory;

use App\Modules\DataIngestion\Contracts\FileReaderInterface;
use App\Modules\DataIngestion\Contracts\FileReaderFactoryInterface;
use App\Modules\DataIngestion\Contracts\SheetFilterBuilderFactoryInterface;
use App\Modules\DataIngestion\Enum\SourceTypeEnum;
use App\Modules\DataIngestion\Services\Csv\Reader\CsvFileReader;

readonly class PhpOfficeFileReaderFactory implements FileReaderFactoryInterface
{

    public function __construct(private SheetFilterBuilderFactoryInterface $sheetFilterBuilderFactory)
    {
    }

    public function createByType(SourceTypeEnum $type): FileReaderInterface
    {
        return match ($type) {
            SourceTypeEnum::CSV => new CsvFileReader($this->sheetFilterBuilderFactory),
            default => throw new \RuntimeException(sprintf('Source type %s not yet implemented!', $type->value)),
        };
    }
}

<?php

namespace App\Modules\DataIngestion\Services\Csv\Factory;

use App\Modules\DataIngestion\Contracts\SheetFilterBuilderFactoryInterface;
use App\Modules\DataIngestion\Contracts\SheetFilterBuilderInterface;
use App\Modules\DataIngestion\Services\Csv\Enum\SheetFilterEnum;
use App\Modules\DataIngestion\Services\Csv\Filter\Builder\CustomeFilterBuilder;
use App\Modules\DataIngestion\Services\Csv\Filter\Builder\DateTimeFilterBuilder;
use App\Modules\DataIngestion\Services\Csv\Filter\Builder\SimpleFilterBuilder;
use App\Modules\DataIngestion\Services\Csv\Filter\Builder\Top10FilterBuilder;

class PhpOfficeSheetFilterBuilderFactory implements SheetFilterBuilderFactoryInterface
{

    public function createByType(SheetFilterEnum $filterType): SheetFilterBuilderInterface
    {
        return match ($filterType) {
            SheetFilterEnum::SIMPLE => new SimpleFilterBuilder(),
            SheetFilterEnum::TOP10 => new Top10FilterBuilder(),
            SheetFilterEnum::CUSTOM => new CustomeFilterBuilder(),
            SheetFilterEnum::DATETIME => new DateTimeFilterBuilder(),
        };
    }
}

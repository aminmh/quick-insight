<?php

namespace App\Modules\DataIngestion\Contracts;

use App\Modules\DataIngestion\Services\Csv\Enum\SheetFilterEnum;

interface SheetFilterBuilderFactoryInterface
{
    public function createByType(SheetFilterEnum $filterType): SheetFilterBuilderInterface;
}

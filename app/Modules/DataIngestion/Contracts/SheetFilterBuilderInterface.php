<?php

namespace App\Modules\DataIngestion\Contracts;

use App\Modules\DataIngestion\Services\Csv\Dto\SheetFilterDto;

interface SheetFilterBuilderInterface
{
    public function filter(WorkSheetInterface $workSheet, SheetFilterDto $dto);
}

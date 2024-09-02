<?php

namespace App\Modules\DataIngestion\Services\Csv\Filter\Builder;

use App\Modules\DataIngestion\Contracts\SheetFilterBuilderInterface;
use App\Modules\DataIngestion\Contracts\SheetFilterInterface;
use App\Modules\DataIngestion\Contracts\WorkSheetInterface;
use App\Modules\DataIngestion\Services\Csv\Dto\SheetFilterDto;
use App\Modules\DataIngestion\Services\Csv\Filter\SimpleFilter;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Top10FilterBuilder implements SheetFilterBuilderInterface
{

    public function filter(WorkSheetInterface $workSheet, SheetFilterDto $dto)
    {
        $filter = $this->build($dto);
        /** @var Worksheet $activeSheet */
        $activeSheet = $workSheet->getWorkSheet();
    }

    private function build(SheetFilterDto $dto): SimpleFilter
    {
        return new SimpleFilter($dto->schema);

    }
}

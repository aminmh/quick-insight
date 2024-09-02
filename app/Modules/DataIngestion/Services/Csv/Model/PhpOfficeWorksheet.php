<?php

namespace App\Modules\DataIngestion\Services\Csv\Model;

use App\Modules\DataIngestion\Contracts\WorkSheetInterface;
use App\Modules\DataIngestion\Services\Csv\Dto\SheetFilterDto;

readonly class PhpOfficeWorksheet implements WorkSheetInterface
{

    public function __construct(private \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $worksheet)
    {
    }

    public function getWorkSheet(): \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
    {
        return $this->worksheet;
    }
}

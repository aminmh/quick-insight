<?php

namespace App\Modules\DataIngestion\Contracts;

use App\Modules\DataIngestion\Services\Csv\Dto\SheetFilterDto;

interface WorkSheetInterface
{

    public function getWorkSheet();
}

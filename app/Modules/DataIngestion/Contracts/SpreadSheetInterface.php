<?php

namespace App\Modules\DataIngestion\Contracts;

interface SpreadSheetInterface
{

    public function setSheet(int|string $sheet);
}

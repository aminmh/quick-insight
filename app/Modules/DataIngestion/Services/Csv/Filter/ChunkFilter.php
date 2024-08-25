<?php

namespace App\Modules\DataIngestion\Services\Csv\Filter;

use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class ChunkFilter implements IReadFilter
{

    public function __construct(private int $startRow, private int $endRow)
    {
    }

    public function setRange(int $startRow, int $endRow): void
    {
        $this->startRow = $startRow;
        $this->endRow = $endRow;
    }

    /**
     * @inheritDoc
     */
    public function readCell(string $columnAddress, int $row, string $worksheetName = ''): bool
    {
        return $row >= $this->startRow && $row <= $this->endRow;
    }
}

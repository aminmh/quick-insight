<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\DataSourceInterface;
use App\Modules\DataIngestion\Services\Csv\Filter\ChunkFilter;
use App\Modules\DataIngestion\Services\Csv\Model\ChunkModel;
use App\Modules\DataIngestion\Services\Csv\Model\RowModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReader;

class FileDataSource implements DataSourceInterface
{

    private IReader $reader;

    public function __construct(private readonly ChunkModel $chunkModel, private string $path)
    {
    }

    public function connect(): void
    {
        $reader = IOFactory::createReaderForFile($this->path);
        $filter = new ChunkFilter($this->chunkModel->start, $this->chunkModel->end);
        $reader->setReadFilter($filter);
        $this->reader = $reader;
    }

    public function disconnect(): void
    {
    }

    public function readData(): array
    {
        $spreadsheet = $this->reader->load($this->path, IReader::IGNORE_ROWS_WITH_NO_CELLS);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->getRowIterator($this->chunkModel->start, $this->chunkModel->end);
        $data = collect();

        foreach ($rows as $key => $row) {
            $rowData = new RowModel($worksheet->getTitle(), intval($key), []);
            foreach ($row->getColumnIterator() as $column) {
                $rowData->addCell($column->getColumn(), $column->getValue());
            }
            $data->add($rowData);
        }

        return $data->toArray();
    }
}

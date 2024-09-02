<?php

namespace App\Modules\DataIngestion\Services\Csv\Reader;

use App\Modules\DataIngestion\Contracts\ChunkedSourceReaderInterface;
use App\Modules\DataIngestion\Contracts\FileReaderInterface;
use App\Modules\DataIngestion\Contracts\SheetFilterBuilderFactoryInterface;
use App\Modules\DataIngestion\Contracts\SpreadSheetInterface;
use App\Modules\DataIngestion\Services\Csv\Dto\SheetFilterDto;
use App\Modules\DataIngestion\Services\Csv\Filter\ChunkFilter;
use App\Modules\DataIngestion\Services\Csv\Model\ChunkModel;
use App\Modules\DataIngestion\Services\Csv\Model\PhpOfficeWorksheet;
use App\Modules\DataIngestion\Services\Csv\Model\RowModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CsvFileReader implements FileReaderInterface, ChunkedSourceReaderInterface, SpreadSheetInterface
{
    private ChunkModel $chunk;

    private Spreadsheet $spreadsheet;

    /**
     * @var SheetFilterDto[]
     */
    private array $filters = [];

    private string $path;

    private int $sheet = 0;

    public function __construct(private readonly SheetFilterBuilderFactoryInterface $sheetFilterBuilderFactory)
    {
    }

    public function setChunk(ChunkModel $chunk): void
    {
        $this->chunk = $chunk;
    }

    public function load(): array
    {
        $reader = IOFactory::createReaderForFile($this->path);
        $reader->setReadDataOnly(true);
        $reader->setReadFilter($this->getChunk());
        $this->spreadsheet = $this->reader->load($this->path, IReader::IGNORE_ROWS_WITH_NO_CELLS);
        $worksheet = $this->spreadsheet->getActiveSheet();

        $this->applyFilters($worksheet);

        $rows = $worksheet->getRowIterator($this->chunk->start, $this->chunk->end);
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

    public function destructor(): void
    {
        $this->spreadsheet->disconnectWorksheets();
    }

    public function setFilters(array $filters): void
    {
        $this->filters = $filters;
    }

    private function getChunk(): ChunkFilter
    {
        return new ChunkFilter($this->chunk->start, $this->chunk->end);
    }

    private function applyFilters(Worksheet $worksheet): void
    {
        $filters = $this->filters;

        foreach ($filters as $filter) {
            //NOTE: For Csv files it's not required because, csv files does not contain more than 1 sheet!
            /*if ($worksheet->getTitle() !== (string)$filter->sheet) {
                continue;
            }*/
            $this->sheetFilterBuilderFactory
                ->createByType($filter->type)
                ->filter(new PhpOfficeWorksheet($worksheet), $filter);
        }
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function setSheet(int|string $sheet): void
    {
        $this->sheet = 0; //Csv has only 1 sheet
    }
}

<?php

namespace App\Http\Controllers;

use App\Modules\DataIngestion\Contracts\ChunkMakerFactoryInterface;
use App\Modules\DataIngestion\Contracts\FileReaderFactoryInterface;
use App\Modules\DataIngestion\Contracts\FileReaderInterface;
use App\Modules\DataIngestion\Contracts\SpreadSheetInterface;
use App\Modules\DataIngestion\Enum\SourceTypeEnum;
use App\Modules\DataIngestion\Services\ChunkedFileDataSource;
use App\Modules\DataIngestion\Services\Csv\Dto\SheetFilterDto;
use App\Modules\DataIngestion\Services\Csv\Model\ChunkModel;
use App\Modules\DataIngestion\Services\FileDataSource;
use Illuminate\Support\Facades\Redis;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\BaseReader;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ExtractorController extends Controller
{

    public function extract(Request $request, FileReaderFactoryInterface $readerFactory): JsonResponse
    {
        $filePath = storage_path('app/public/kickstarter_projects.csv');
        /** @var BaseReader $reader */
        $reader = IOFactory::createReader(IOFactory::READER_CSV);
        $chunkSize = 100;
        $sheetInfo = $reader->listWorksheetInfo($filePath);
        $sheetInfo = array_shift($sheetInfo);
        $totalRows = /*$sheetInfo['totalRows']*/
            200;
        $createdChunks = 1;
        /** @var FileReaderInterface&SpreadSheetInterface $sourceReader */
        $sourceReader = $readerFactory->createByType(SourceTypeEnum::CSV);
        $sourceReader->setPath($filePath);
        $sourceReader->setSheet(0);
        $filters = [];
        $range = $request->get('range');
        foreach ($request->get('filters') as $filter) {
            $filters[] = SheetFilterDto::fromArray($filter, $range);
        }

        while ($createdChunks <= $totalRows) {
            $chunk = new ChunkModel($createdChunks + 1, $createdChunks + $chunkSize);
            $message = new ChunkedFileDataSource($sourceReader);
            $message->setChunk($chunk);
            $message->setFilters($filters);
            \App\Modules\DataIngestion\Jobs\ProcessIngestedData::dispatch($message);
            $createdChunks += $chunkSize;
        }

        return response()->json(['message' => 'Extracted!', 'data' => $createdChunks]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Modules\DataIngestion\Services\Csv\Model\ChunkModel;
use App\Modules\DataIngestion\Services\FileDataSource;
use Illuminate\Support\Facades\Redis;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\BaseReader;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExtractorController extends Controller
{
    private \Redis $redis;

    public function __construct()
    {
        $this->redis = Redis::client();
    }

    public function extract(): JsonResponse
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

        while ($createdChunks <= $totalRows) {
            $chunk = new ChunkModel($createdChunks + 1, $createdChunks + $chunkSize);
            $message = new FileDataSource($chunk, $filePath);
            \App\Modules\DataIngestion\Jobs\ProcessIngestedData::dispatch($message);
            $createdChunks += $chunkSize;
        }

        return response()->json(['message' => 'Extracted!', 'data' => $createdChunks]);
    }
}

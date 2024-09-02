<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\DataIngestionServiceInterface;
use App\Modules\DataIngestion\Contracts\FileReaderFactoryInterface;
use App\Modules\DataIngestion\Contracts\FileReaderInterface;

readonly class DataIngestionService implements DataIngestionServiceInterface
{

    public function __construct(private FileReaderFactoryInterface $fileReaderFactory)
    {
    }

    public function readSpreadsheetFile(string $path, array $filters = [])
    {
        // TODO: Implement readFile() method.
    }

    public function readSpreadsheetFileAsChunk(string $path, int $chunkSize, array $filters = [])
    {
        // TODO: Implement readFileAsChunk() method.
    }

    public function readUrl(string $url)
    {
        // TODO: Implement readUrl() method.
    }

    public function readRemoteSource(string $source)
    {
        // TODO: Implement readRemoteSource() method.
    }
}

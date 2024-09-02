<?php

namespace App\Modules\DataIngestion\Contracts;

interface DataIngestionServiceInterface
{

    public function readSpreadsheetFile(string $path, array $filters = []);

    public function readSpreadsheetFileAsChunk(string $path, int $chunkSize, array $filters = []);

    public function readUrl(string $url);

    public function readRemoteSource(string $source);
}

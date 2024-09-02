<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\ChunkedSourceReaderInterface;
use App\Modules\DataIngestion\Contracts\DataSourceInterface;
use App\Modules\DataIngestion\Contracts\DataSourceIsChunkedInterface;
use App\Modules\DataIngestion\Services\Csv\Model\ChunkModel;

class ChunkedFileDataSource implements DataSourceInterface, DataSourceIsChunkedInterface
{

    private array $filters;
    private ChunkModel $chunkModel;

    public function __construct(private readonly ChunkedSourceReaderInterface $sourceReader)
    {
    }

    public function connect(): void
    {
    }

    public function disconnect(): void
    {
    }

    public function readData(): array
    {
        $this->sourceReader->setChunk($this->getChunk());
        $this->sourceReader->setFilters($this->filters);
        $data = $this->sourceReader->load();
        $this->sourceReader->destructor();
        return $data;
    }

    public function setFilters(array $filters): void
    {
        $this->filters = $filters;
    }

    public function setChunk(ChunkModel $chunk): void
    {
        $this->chunkModel = $chunk;
    }

    public function getChunk(): ChunkModel
    {
        return $this->chunkModel;
    }
}

<?php

namespace App\Modules\DataIngestion\Contracts;

use App\Modules\DataIngestion\Services\Csv\Model\ChunkModel;

interface ChunkedSourceReaderInterface
{
    public function setChunk(ChunkModel $chunk);
}

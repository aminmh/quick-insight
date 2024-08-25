<?php

namespace App\Modules\DataIngestion\Services\Csv\Model;

readonly class ChunkModel
{

    public function __construct(public int $start, public int $end)
    {
    }
}

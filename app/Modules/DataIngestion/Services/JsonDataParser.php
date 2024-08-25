<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\DataParserInterface;

class JsonDataParser implements DataParserInterface
{
    public function parse(array $data): array
    {
        return $data;
    }
}

<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\DataParserInterface;

class JsonDataParser implements DataParserInterface
{
    public function parse(string $data): array
    {
        return json_decode($data, true);
    }
}

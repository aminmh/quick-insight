<?php

namespace App\Modules\DataIngestion\Contracts;

interface DataParserInterface
{
    public function parse(string $data): array;
}

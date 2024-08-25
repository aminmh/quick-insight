<?php

namespace App\Modules\DataIngestion\Contracts;

interface DataParserInterface
{
    public function parse(array $data): array;
}

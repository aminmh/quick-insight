<?php

namespace App\Modules\DataIngestion\Contracts;

use App\Modules\DataIngestion\Enum\SourceTypeEnum;

interface FileReaderFactoryInterface
{

    public function createByType(SourceTypeEnum $type): FileReaderInterface;
}

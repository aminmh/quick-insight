<?php

namespace App\Modules\DataIngestion\Services\Csv\Enum;

enum SheetFilterEnum: string
{
    case SIMPLE = 'simple';
    case TOP10 = 'top10';
    case CUSTOM = 'custom';
    case DATETIME = 'datetime';
}

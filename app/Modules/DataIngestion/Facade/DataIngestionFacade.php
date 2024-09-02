<?php

namespace App\Modules\DataIngestion\Facade;

use App\Modules\DataIngestion\Contracts\DataIngestionServiceInterface;
use Illuminate\Support\Facades\Facade;

class DataIngestionFacade extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return DataIngestionServiceInterface::class;
    }
}

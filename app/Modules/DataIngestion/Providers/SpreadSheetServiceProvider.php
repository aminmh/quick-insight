<?php

namespace App\Modules\DataIngestion\Providers;

use App\Modules\DataIngestion\Contracts\DataIngestionServiceInterface;
use App\Modules\DataIngestion\Contracts\FileReaderFactoryInterface;
use App\Modules\DataIngestion\Contracts\SheetFilterBuilderFactoryInterface;
use App\Modules\DataIngestion\Factory\PhpOfficeFileReaderFactory;
use App\Modules\DataIngestion\Services\Csv\Factory\PhpOfficeSheetFilterBuilderFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class SpreadSheetServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(SheetFilterBuilderFactoryInterface::class, PhpOfficeSheetFilterBuilderFactory::class);
        $this->app->bind(FileReaderFactoryInterface::class, function (Application $application) {
            return new PhpOfficeFileReaderFactory($application->get(SheetFilterBuilderFactoryInterface::class));
        });
        $this->app->bind(DataIngestionServiceInterface::class, function (Application $application) {

        });
    }
}

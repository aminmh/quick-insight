<?php

namespace App\Modules\DataIngestion\Providers;

use App\Modules\DataIngestion\Events\DataIngested;
use App\Modules\DataIngestion\Listeners\StoreIngestedData;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Event;

class DataIngestionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \App\Modules\DataIngestion\Contracts\DataSourceInterface::class,
            \App\Modules\DataIngestion\Services\FileDataSource::class
        );

        $this->app->bind(
            \App\Modules\DataIngestion\Contracts\DataCollectorInterface::class,
            \App\Modules\DataIngestion\Services\BatchDataCollector::class
        );

        $this->app->bind(
            \App\Modules\DataIngestion\Contracts\DataParserInterface::class,
            \App\Modules\DataIngestion\Services\JsonDataParser::class
        );

        $this->app->bind(
            \App\Modules\DataIngestion\Contracts\DataValidatorInterface::class,
            \App\Modules\DataIngestion\Services\SchemaValidator::class
        );

        $this->app->bind(
            \App\Modules\DataIngestion\Contracts\DataBufferInterface::class,
            \App\Modules\DataIngestion\Services\InMemoryBuffer::class
        );
    }

    public function boot()
    {
        Event::listen(DataIngested::class, StoreIngestedData::class);
    }

}

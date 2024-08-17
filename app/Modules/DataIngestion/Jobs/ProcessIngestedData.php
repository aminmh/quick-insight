<?php

namespace App\Modules\DataIngestion\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Modules\DataIngestion\Services\IngestionManager;
use App\Modules\DataIngestion\Contracts\DataSourceInterface;
class ProcessIngestedData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $source;

    public function __construct(DataSourceInterface $source)
    {
        $this->source = $source;
    }

    public function handle(IngestionManager $manager)
    {
        $manager->ingest($this->source);
    }
}

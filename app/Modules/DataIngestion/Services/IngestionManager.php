<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\DataCollectorInterface;
use App\Modules\DataIngestion\Contracts\DataParserInterface;
use App\Modules\DataIngestion\Contracts\DataValidatorInterface;
use App\Modules\DataIngestion\Contracts\DataBufferInterface;
use App\Modules\DataIngestion\Contracts\DataSourceInterface;
use App\Modules\DataIngestion\Events\DataIngested;
class IngestionManager
{
    private $collector;
    private $parser;
    private $validator;
    private $buffer;

    public function __construct(
        DataCollectorInterface $collector,
        DataParserInterface $parser,
        DataValidatorInterface $validator,
        DataBufferInterface $buffer
    ) {
        $this->collector = $collector;
        $this->parser = $parser;
        $this->validator = $validator;
        $this->buffer = $buffer;
    }

    public function ingest(DataSourceInterface $source)
    {
        $rawData = $this->collector->collectData($source);
        $parsedData = $this->parser->parse($rawData);

        if ($this->validator->validate($parsedData)) {
            $this->buffer->add($parsedData);
            event(new DataIngested($this->buffer->get()));
        }
    }
}

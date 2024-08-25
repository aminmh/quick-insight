<?php

namespace App\Modules\DataIngestion\Listeners;

use App\Modules\DataIngestion\Events\DataIngested;
use App\Modules\DataIngestion\Services\Csv\Model\RowModel;
use Illuminate\Support\Facades\Redis;

class StoreIngestedData
{
    public function handle(DataIngested $event): void
    {
        /** @var RowModel[] $rows */
        $rows = $event->data;
        $sheet = $rows[array_key_first($rows)]->sheet;

        foreach ($rows as $row) {
            try {
                Redis::client()->hSet($sheet, $row->number, json_encode($row->data, JSON_PRETTY_PRINT));
            }catch (\RedisException $exception) {
                $this->log($row, $exception->getMessage());
            }
        }

    }

    private function log(RowModel $row, string $message): void
    {
        $stream = fopen(storage_path('app/temp/ingested-data.log'), 'a+');
        $log = sprintf("[%s] exception:%s row:%d (%s)\n", date('Y-m-d H:i:s'), $message, $row->number, json_encode($row->data, JSON_PRETTY_PRINT));
        fwrite($stream, $log);
        fclose($stream);
    }

}

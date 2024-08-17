<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\DataSourceInterface;

class FileDataSource implements DataSourceInterface
{
    private $filePath;
    private $fileHandle;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function connect(): void
    {
        $this->fileHandle = fopen($this->filePath, 'r');
    }

    public function disconnect(): void
    {
        if ($this->fileHandle) {
            fclose($this->fileHandle);
        }
    }

    public function readData(): string
    {
        $data = '';
        // Reset the file pointer to the beginning of the file
        rewind($this->fileHandle);

        // Read the file line by line until the end of the file
        while (!feof($this->fileHandle)) {
            $line = fgets($this->fileHandle);
            $data .= $line;
        }

        return $data;
    }
}

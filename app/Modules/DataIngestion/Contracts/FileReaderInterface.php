<?php

namespace App\Modules\DataIngestion\Contracts;

interface FileReaderInterface
{
    public function load();

    public function setPath(string $path);

    public function setFilters(array $filters);

    public function destructor(): void;
}

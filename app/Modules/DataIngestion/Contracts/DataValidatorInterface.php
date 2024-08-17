<?php

namespace App\Modules\DataIngestion\Contracts;

interface DataValidatorInterface
{
    public function validate(array $data): bool;
}

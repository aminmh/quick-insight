<?php

namespace App\Modules\DataIngestion\Services;

use App\Modules\DataIngestion\Contracts\DataValidatorInterface;

class SchemaValidator implements DataValidatorInterface
{
    public function validate(array $data): bool
    {
        // Implement schema validation logic here
        return true;
    }
}

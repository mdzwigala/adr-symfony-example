<?php
declare(strict_types=1);

namespace App\Infrastructure\Validator;

use App\Infrastructure\Exception\DataValidationException;

interface DataValidator
{
    /** @throws DataValidationException */
    public function validate($data): void;
}

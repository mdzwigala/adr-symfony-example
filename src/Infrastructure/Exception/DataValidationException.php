<?php
declare(strict_types=1);

namespace App\Infrastructure\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class DataValidationException extends HttpException
{
    private array $errors;

    public function __construct(array $errorMessages)
    {
        parent::__construct(Response::HTTP_UNPROCESSABLE_ENTITY, 'Data Validation Exception: ' . json_encode($errorMessages));
        $this->errors = $errorMessages;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

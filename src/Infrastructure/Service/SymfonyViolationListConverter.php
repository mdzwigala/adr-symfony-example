<?php
declare(strict_types=1);

namespace App\Infrastructure\Service;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class SymfonyViolationListConverter
{
    public function convertToArray(ConstraintViolationListInterface $list): array
    {
        $errors = [];
        /** @var ConstraintViolation $violation */
        foreach ($list as $violation) {
            $errors[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        return $errors;
    }
}

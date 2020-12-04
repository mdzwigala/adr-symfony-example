<?php
declare(strict_types=1);

namespace App\Infrastructure\ParamConverter\InputFactory;

use Symfony\Component\HttpFoundation\Request;

interface InputFactory
{
    public function __construct();

    public function createFromRequest(Request $request): object;

    public function supportedInput(): string;
}

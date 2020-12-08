<?php
declare(strict_types=1);

namespace App\Infrastructure\ParamConverter\InputFactory;

use App\Action\Input\AddUserInput;
use Symfony\Component\HttpFoundation\Request;

final class AddUserInputFactory implements InputFactory
{
    public function createFromRequest(Request $request): AddUserInput
    {
        return new AddUserInput(
            (string)$request->request->get('email', ''),
            (string)$request->request->get('password', '')
        );
    }

    public function createFromData(string $email, $password): AddUserInput
    {
        return new AddUserInput(
            $email,
            $password
        );
    }

    public static function supportedInput(): string
    {
        return AddUserInput::class;
    }
}

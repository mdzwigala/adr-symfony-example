<?php
declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Action\AddUser;
use App\Infrastructure\ParamConverter\InputFactory\AddUserInputFactory;
use App\Infrastructure\Responder\ConsoleResponder;
use App\Infrastructure\Validator\DataValidator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('user:add', 'Creates new User')]
final class AddUserCommand extends Command
{
    private const EMAIL = 'email';
    private const PASSWORD = 'password';

    public function __construct(
        private readonly DataValidator $validator,
        private readonly AddUser $addUser,
        private readonly AddUserInputFactory $inputFactory,
        private readonly ConsoleResponder $consoleResponder
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addArgument(self::EMAIL, InputArgument::REQUIRED, 'User email')
            ->addArgument(self::PASSWORD, InputArgument::REQUIRED, 'User password');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $addUserInput = $this->inputFactory->createFromData(
            $input->getArgument(self::EMAIL),
            $input->getArgument(self::PASSWORD)
        );

        $this->validator->validate($addUserInput);

        $addUserOutput = $this->addUser->__invoke($addUserInput);

        $this->consoleResponder->__invoke($output, $addUserOutput);

        return Command::SUCCESS;
    }
}

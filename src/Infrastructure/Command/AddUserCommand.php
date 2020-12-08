<?php
declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Action\AddUser;
use App\Infrastructure\ParamConverter\InputFactory\AddUserInputFactory;
use App\Infrastructure\Responder\ConsoleResponder;
use App\Infrastructure\Validator\DataValidator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class AddUserCommand extends Command
{
    protected static $defaultName = 'user:add';

    private const EMAIL = 'email';
    private const PASSWORD = 'password';

    private AddUser $addUser;

    private AddUserInputFactory $inputFactory;

    private DataValidator $validator;

    private ConsoleResponder $consoleResponder;

    public function __construct(
        DataValidator $validator,
        AddUser $addUser,
        AddUserInputFactory $inputFactory,
        ConsoleResponder $consoleResponder
    )
    {
        parent::__construct();
        $this->addUser = $addUser;
        $this->inputFactory = $inputFactory;
        $this->validator = $validator;
        $this->consoleResponder = $consoleResponder;
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates new User')
            ->addArgument(self::EMAIL, InputArgument::REQUIRED, 'User email')
            ->addArgument(self::PASSWORD, InputArgument::REQUIRED, 'User password');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
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

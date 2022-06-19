<?php
declare(strict_types=1);

namespace App\Action;

use App\Action\Input\AddUserInput;
use App\Action\Output\AddUserOutput;
use App\Domain\Factory\UserFactory;
use App\Domain\Model\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

final class AddUser
{
    public function __construct(private readonly Users $users, private readonly UserFactory $userFactory)
    {
    }

    #[ParamConverter('input', converter: 'converter.action_input')]
    public function __invoke(AddUserInput $input): AddUserOutput
    {
        $user = $this->userFactory->fromAddUserInput($input);

        $this->users->add($user);

        return new AddUserOutput($user->id());
    }
}

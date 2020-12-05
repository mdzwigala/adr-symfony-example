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
    private Users $users;

    private UserFactory $userFactory;

    public function __construct(Users $users, UserFactory $userFactory)
    {
        $this->users = $users;
        $this->userFactory = $userFactory;
    }

    /**
     * @ParamConverter(converter="converter.action_input", name="input")
     */
    public function __invoke(AddUserInput $input): AddUserOutput
    {
        $user = $this->userFactory->fromAddUserInput($input);

        $this->users->add($user);

        return new AddUserOutput($user->id());
    }
}

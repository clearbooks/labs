<?php
namespace Clearbooks\Labs\AutoSubscribe\Gateway;

use Clearbooks\Labs\AutoSubscribe\Entity\User;

class AutoSubscriberProviderStub implements AutoSubscriberProvider
{
    /**
     * @var User[]
     */
    private $users;

    /**
     * AutoSubscriberProviderStub constructor.
     * @param User[] $users
     */
    public function __construct(array $users)
    {
        $this->users = $users;
    }

    /**
     * @return User[]
     */
    public function getSubscribers()
    {
        return $this->users;
    }
}
//EOF AutoSubscriberProviderStub.php
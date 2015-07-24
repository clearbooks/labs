<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 24/07/15
 * Time: 11:34
 */

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
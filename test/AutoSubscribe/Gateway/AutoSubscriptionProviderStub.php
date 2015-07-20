<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 16:52
 */

namespace Clearbooks\Labs\AutoSubscribe\Gateway;


class AutoSubscriptionProviderStub implements AutoSubscriptionProvider
{
    /**
     * @var
     */
    private $subscribedUsers;


    /**
     * AutoSubscriptionProviderStub constructor.
     * @param $subscribedUsers
     */
    public function __construct($subscribedUsers)
    {
        $this->subscribedUsers = $subscribedUsers;
    }

    /**
     * @param int $userId
     * @return boolean
     */
    public function isSubscribed($userId)
    {
        return isset($this->subscribedUsers[$userId]);
    }

    /**
     * @param int $userId
     * @return void
     */
    public function subscribe($userId)
    {
        $this->subscribedUsers[$userId] = true;
    }

    /**
     * @param int $userId
     * @return void
     */
    public function unSubscribe($userId)
    {
        unset($this->subscribedUsers[$userId]);
    }
}
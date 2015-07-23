<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 12:10
 */

namespace Clearbooks\Labs\AutoSubscribe\Object;


use Clearbooks\Labs\AutoSubscribe\Entity\Subscription;

class SubscriptionSpy implements Subscription
{
    private $isSubscribedCalled = false;

    /**
     * @return bool
     */
    public function IsSubscribed()
    {
        $this->isSubscribedCalled = true;
    }

    /**
     * @return boolean
     */
    public function isSubscribedCalled()
    {
        return $this->isSubscribedCalled;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return 0;
    }
}
//EOF SubscriptionSpy.php
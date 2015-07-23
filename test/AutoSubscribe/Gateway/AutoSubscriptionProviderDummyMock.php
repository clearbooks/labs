<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 10:47
 */

namespace Clearbooks\Labs\AutoSubscribe\Gateway;


use Clearbooks\Labs\AutoSubscribe\Entity\Subscription;
use Clearbooks\Labs\AutoSubscribe\Entity\User;

class AutoSubscriptionProviderDummyMock extends AutoSubscriptionProviderUpdateMock
{

    /**
     * @return Subscription[]
     */
    public function getSubscriptions()
    {
        parent::getSubscriptions();
        return [];
    }

    /**
     * @param User $user
     * @return Subscription|null
     */
    public function getSubscription(User $user)
    {
        parent::getSubscription($user);
        return null;
    }

    /**
     * @param User $user
     * @param bool $subscribe
     * @return Subscription|null new subscription entity
     */
    public function updateSubscription(User $user, $subscribe)
    {
        parent::updateSubscription($user,$subscribe);
        return null;
    }
}
//EOF AutoSubscriptionProviderDummyMock.php
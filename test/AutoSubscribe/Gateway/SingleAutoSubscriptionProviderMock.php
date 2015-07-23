<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 10:54
 */

namespace Clearbooks\Labs\AutoSubscribe\Gateway;


use Clearbooks\Labs\AutoSubscribe\Entity\Subscription;
use Clearbooks\Labs\AutoSubscribe\Entity\User;

class SingleAutoSubscriptionProviderMock extends AutoSubscriptionProviderUpdateMock
{
    /**
     * @var Subscription
     */
    private $subscription;

    /**
     * SingleAutoSubscriptionProviderMock constructor.
     * @param Subscription $subscription
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * @return Subscription[]
     */
    public function getSubscriptions()
    {
        parent::getSubscriptions();
        return [$this->subscription];
    }

    /**
     * @param User $user
     * @return Subscription|null
     */
    public function getSubscription(User $user)
    {
        parent::getSubscription($user);
        return $this->subscription;
    }

    /**
     * @param User $user
     * @param bool $subscribe
     * @return Subscription|null new subscription entity
     */
    public function updateSubscription(User $user, $subscribe)
    {
        parent::updateSubscription($user, $subscribe);
        return $this->subscription;
    }
}
//EOF SingleAutoSubscriptionProviderMock.php
<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 16:52
 */

namespace Clearbooks\Labs\AutoSubscribe\Gateway;


use Clearbooks\Labs\AutoSubscribe\Entity\Subscription;
use Clearbooks\Labs\AutoSubscribe\Entity\User;
use Clearbooks\Labs\AutoSubscribe\Object\MutableSubscription;

class AutoSubscriptionProviderMock implements AutoSubscriptionProvider
{
    /**
     * @var MutableSubscription[]
     */
    private $subscriptions;


    /**
     * AutoSubscriptionProviderMock constructor.
     * @param MutableSubscription[] $subscribedUsers
     */
    public function __construct($subscribedUsers)
    {
        $this->subscriptions = $subscribedUsers;
    }

    /**
     * @param User $user
     * @return Subscription|null
     */
    public function getSubscription(User $user)
    {
        foreach ($this->subscriptions as $s) {
            if ($s->getUser()->getId() === $user->getId()) {
                return $s;
            }
        }
        return null;
    }

    /**
     * @return Subscription[]
     */
    public function getSubscriptions()
    {
        return $this->subscriptions;
    }

    /**
     * @param User $user
     * @param bool $subscribe
     * @return Subscription|null new subscription entity
     */
    public function updateSubscription(User $user, $subscribe)
    {
        /** @var MutableSubscription $subscription */
        $subscription = $this->getSubscription($user);
        if ( $subscription !== null ) {
            $subscription->setSubscription($subscribe);
        }
        return $subscription;
    }

    /**
     * @param User $user
     * @param bool $subscribe
     * @return Subscription|null new subscription entity
     */
    public function addSubscription(User $user, $subscribe)
    {
        $subscription = $this->getSubscription($user);
        if ( $subscription === null ) {
            $subscription = new MutableSubscription($user,$subscribe);
            $this->subscriptions[] = $subscription;
        } else {
            $subscription = $this->updateSubscription($user,$subscribe);
        }
        return $subscription;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 16:16
 */

namespace Clearbooks\Labs\AutoSubscribe\Gateway;


use Clearbooks\Labs\AutoSubscribe\Entity\Subscription;
use Clearbooks\Labs\AutoSubscribe\Entity\User;

interface AutoSubscriptionProvider
{
    /**
     * @return Subscription[]
     */
    public function getSubscriptions();

    /**
     * @param User $user
     * @return Subscription
     */
    public function getSubscription(User $user);

    /**
     * @param User $user
     * @param bool $subscribe
     * @return Subscription|null new subscription entity
     */
    public function updateSubscription(User $user, $subscribe);

    /**
     * @param User $user
     * @param bool $subscribe
     * @return Subscription|null new subscription entity
     */
    public function addSubscription(User $user, $subscribe);
}
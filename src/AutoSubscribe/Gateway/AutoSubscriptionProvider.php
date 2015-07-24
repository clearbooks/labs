<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 16:16
 */

namespace Clearbooks\Labs\AutoSubscribe\Gateway;


use Clearbooks\Labs\AutoSubscribe\Entity\User;

interface AutoSubscriptionProvider
{
    /**
     * @param User $user
     * @param bool $subscribe
     */
    public function updateSubscription(User $user, $subscribe);

    /**
     * @param User $user
     * @return bool
     */
    public function isSubscribed($user);
}
//EOF AutoSubscriptionProvider.php
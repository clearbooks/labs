<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 11:09
 */

namespace Clearbooks\Labs\AutoSubscribe\Object;


class FalseSubscription extends SubscriptionSpy
{
    /**
     * @return bool
     */
    public function IsSubscribed()
    {
        parent::IsSubscribed();
        return false;
    }
}
//EOF FalseSubscription.php
<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 11:02
 */

namespace Clearbooks\Labs\AutoSubscribe\Object;


class TrueSubscription extends SubscriptionSpy
{
    /**
     * @return bool
     */
    public function IsSubscribed()
    {
        parent::IsSubscribed();
        return true;
    }
}
//EOF TrueSubscription.php
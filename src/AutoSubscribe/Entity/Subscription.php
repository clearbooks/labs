<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 21/07/15
 * Time: 13:42
 */

namespace Clearbooks\Labs\AutoSubscribe\Entity;


interface Subscription
{
    /**
     * @return bool
     */
    public function IsSubscribed();

    /**
     * @return int
     */
    public function getUserId();
}
//EOF Subscription.php
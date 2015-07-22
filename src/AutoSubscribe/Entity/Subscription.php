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
     * @return User
     */
    public function getUser();

    /**
     * @return bool
     */
    public function IsSubscribed();
}
//EOF Subscription.php
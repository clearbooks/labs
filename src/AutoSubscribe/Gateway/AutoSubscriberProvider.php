<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 24/07/15
 * Time: 10:35
 */

namespace Clearbooks\Labs\AutoSubscribe\Gateway;


use Clearbooks\Labs\AutoSubscribe\Entity\User;

interface AutoSubscriberProvider
{
    /**
     * @return User[]
     */
    public function getSubscribers();
}
//EOF AutoSubscriberProvider.php
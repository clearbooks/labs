<?php
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
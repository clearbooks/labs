<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 16:16
 */

namespace Clearbooks\Labs\AutoSubscribe\Gateway;


interface AutoSubscriptionProvider
{
    /**
     * @param int $userId
     * @return boolean
     */
    public function isSubscribed($userId);

    /**
     * @param int $userId
     * @return void
     */
    public function subscribe($userId);

    /**
     * @param int $userId
     * @return void
     */
    public function unSubscribe($userId);
}
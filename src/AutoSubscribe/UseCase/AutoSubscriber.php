<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 15:11
 */

namespace Clearbooks\Labs\AutoSubscribe\UseCase;


interface AutoSubscriber
{
    /**
     * @return boolean
     */
    public function isUserAutoSubscribed();

    public function subscribe();

    public function unSubscribe();
}
<?php
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
//EOF AutoSubscriber.php
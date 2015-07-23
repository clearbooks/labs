<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 11:55
 */

namespace Clearbooks\Labs\AutoSubscribe\Gateway;


class AutoSubscriptionProviderUpdateMock extends AutoSubscriptionProviderSpy
{
    /**
     * @param bool $subscribe
     * @return bool
     */
    public function isUpdateCalledWith($subscribe) {
        return $this->isUpdateSubscriptionCalled() && $this->isUpdateSubscriptionParamSubscribe() === $subscribe;
    }
}
//EOF AutoSubscriptionProviderUpdateMock.php
<?php
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
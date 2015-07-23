<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 11:11
 */

namespace Clearbooks\Labs\AutoSubscribe\Gateway;


use Clearbooks\Labs\AutoSubscribe\Entity\Subscription;
use Clearbooks\Labs\AutoSubscribe\Entity\User;

class AutoSubscriptionProviderSpy implements AutoSubscriptionProvider
{
    /** @var bool */
    protected $getSubscriptionCalled;
    /** @var bool */
    protected $updateSubscriptionCalled;
    /** @var bool */
    protected $getSubscriptionsCalled;
    /** @var bool */
    protected $updateSubscriptionParamSubscribe;

    /**
     * @return Subscription[]
     */
    public function getSubscriptions()
    {
        $this->getSubscriptionsCalled = true;
    }

    /**
     * @param User $user
     * @return Subscription|null
     */
    public function getSubscription(User $user)
    {
        $this->getSubscriptionCalled = true;
    }

    /**
     * @param User $user
     * @param bool $subscribe
     * @return Subscription|null new subscription entity
     */
    public function updateSubscription(User $user, $subscribe)
    {
        $this->updateSubscriptionParamSubscribe = $subscribe;
        $this->updateSubscriptionCalled = true;
    }

    /**
     * @return boolean
     */
    public function isGetSubscriptionCalled()
    {
        return $this->getSubscriptionCalled;
    }

    /**
     * @return boolean
     */
    public function isUpdateSubscriptionCalled()
    {
        return $this->updateSubscriptionCalled;
    }

    /**
     * @return boolean
     */
    public function isGetSubscriptionsCalled()
    {
        return $this->getSubscriptionsCalled;
    }

    /**
     * @return boolean
     */
    public function isUpdateSubscriptionParamSubscribe()
    {
        return $this->updateSubscriptionParamSubscribe;
    }
}
//EOF AutoSubscriptionProviderSpy.php
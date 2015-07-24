<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 11:11
 */

namespace Clearbooks\Labs\AutoSubscribe\Gateway;


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
    /** @var bool */
    private $subscription;
    /** @var bool */
    private $isSubscribedCalled;

    /**
     * AutoSubscriptionProviderSpy constructor.
     * @param bool $subscription
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * @param User $user
     * @param bool $subscribe
     */
    public function updateSubscription(User $user, $subscribe)
    {
        $this->updateSubscriptionParamSubscribe = $subscribe;
        $this->updateSubscriptionCalled = true;
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
    public function isUpdateSubscriptionParamSubscribe()
    {
        return $this->updateSubscriptionParamSubscribe;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isSubscribed($user)
    {
        $this->isSubscribedCalled = true;
        return $this->subscription;
    }

    /**
     * @return boolean
     */
    public function isSubscribedCalled()
    {
        return $this->isSubscribedCalled;
    }
}
//EOF AutoSubscriptionProviderSpy.php
<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 14:40
 */
namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\AutoSubscribe\Entity\User;
use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProvider;
use Clearbooks\Labs\AutoSubscribe\UseCase\AutoSubscriber;

class UserAutoSubscriber implements AutoSubscriber
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var AutoSubscriptionProvider
     */
    private $autoSubscriptionProvider;
    /** @var   */
    private $userSubscription;

    /**
     * UserAutoSubscriber constructor.
     * @param User $user
     * @param AutoSubscriptionProvider $autoSubscriptionProvider
     */
    public function __construct(User $user, AutoSubscriptionProvider $autoSubscriptionProvider)
    {
        $this->user = $user;
        $this->autoSubscriptionProvider = $autoSubscriptionProvider;
    }

    /**
     * @return boolean
     */
    public function isUserAutoSubscribed()
    {
        return $this->autoSubscriptionProvider->isSubscribed($this->user);
    }

    public function subscribe()
    {
        if ( !$this->isUserAutoSubscribed() ) {
            $this->userSubscription = $this->autoSubscriptionProvider->updateSubscription($this->user,true);
        }
    }

    public function unSubscribe()
    {
        if ( $this->isUserAutoSubscribed() ) {
            $this->autoSubscriptionProvider->updateSubscription($this->user,false);
        }
    }
}
//EOF UserAutoSubscriber.php
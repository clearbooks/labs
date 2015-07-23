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
use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\Event\UseCase\ToggleShowSubscriber;

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
        $this->userSubscription = $autoSubscriptionProvider->getSubscription($user);
        $this->autoSubscriptionProvider = $autoSubscriptionProvider;
    }

    /**
     * @return boolean
     */
    public function isUserAutoSubscribed()
    {
        return isset($this->userSubscription) ?
            $this->userSubscription->IsSubscribed():
            false;
    }

    public function subscribe()
    {
        if ( isset( $this->userSubscription ) ) {
            if ( !$this->userSubscription->IsSubscribed() ) {
                $this->userSubscription = $this->autoSubscriptionProvider->updateSubscription($this->user,true);
            }
        } else {
            $this->userSubscription = $this->autoSubscriptionProvider->updateSubscription($this->user,true);
        }
    }

    public function unSubscribe()
    {
        if ( isset( $this->userSubscription ) ) {
            if ( $this->userSubscription->IsSubscribed() ) {
                $this->userSubscription = $this->autoSubscriptionProvider->updateSubscription($this->user,false);
            }
        }
    }
}
//EOF UserAutoSubscriber.php
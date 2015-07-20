<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 14:40
 */
namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProvider;
use Clearbooks\Labs\AutoSubscribe\UseCase\AutoSubscriber;

class UserAutoSubscriber implements AutoSubscriber
{
    /**
     * @var int
     */
    private $userId;
    /**
     * @var AutoSubscriptionProvider
     */
    private $autoSubscriptionProvider;

    /**
     * UserAutoSubscriber constructor.
     * @param int $userId
     * @param AutoSubscriptionProvider $autoSubscriptionProvider
     */
    public function __construct($userId, AutoSubscriptionProvider $autoSubscriptionProvider)
    {
        $this->userId = $userId;
        $this->autoSubscriptionProvider = $autoSubscriptionProvider;
    }

    /**
     * @return boolean
     */
    public function isUserAutoSubscribed()
    {
        return $this->autoSubscriptionProvider->isSubscribed($this->userId);
    }

    public function userAutoSubscribe()
    {
        $this->autoSubscriptionProvider->subscribe($this->userId);
    }

    public function userUnSubscribe()
    {
        $this->autoSubscriptionProvider->unsubscribe($this->userId);
    }
}
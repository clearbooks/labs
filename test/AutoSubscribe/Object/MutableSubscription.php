<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 21/07/15
 * Time: 14:42
 */

namespace Clearbooks\Labs\AutoSubscribe\Object;


use Clearbooks\Labs\AutoSubscribe\Entity\Subscription;
use Clearbooks\Labs\AutoSubscribe\Entity\User;

class MutableSubscription implements Subscription
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var bool
     */
    private $subscription;

    /**
     * MutableSubscription constructor.
     * @param User $user
     * @param bool $subscription
     */
    public function __construct(User $user, $subscription)
    {
        $this->user = $user;
        $this->subscription = $subscription;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return bool
     */
    public function IsSubscribed()
    {
        return $this->subscription;
    }

    /**
     * @param boolean $subscription
     */
    public function setSubscription($subscription)
    {
        $this->subscription = $subscription;
    }
}
//EOF MutableSubscription.php
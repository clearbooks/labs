<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 14:35
 */

namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProviderMock;
use Clearbooks\Labs\AutoSubscribe\Object\MutableSubscription;
use Clearbooks\Labs\AutoSubscribe\Object\UserStub;
use Clearbooks\Labs\AutoSubscribe\UseCase\AutoSubscriber;

class UserAutoSubscriberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AutoSubscriber
     */
    private $unSubscribedUser;
    /**
     * @var AutoSubscriber
     */
    private $subscribedUser;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $user1 = new UserStub(1);
        $user2 = new UserStub(2);
        $user3 = new UserStub(3);
        $autoSubscriptionProvider = new AutoSubscriptionProviderMock([
            new MutableSubscription($user2,true),
            new MutableSubscription($user3,false),
        ]);
        $this->unSubscribedUser = new UserAutoSubscriber($user1, $autoSubscriptionProvider);
        $this->subscribedUser = new UserAutoSubscriber($user2, $autoSubscriptionProvider);
    }

    /**
     * @test
     */
    public function GivenANewUser_ThenAutoSubscriptionShouldBeUnSet()
    {
        $this->assertFalse($this->unSubscribedUser->isUserAutoSubscribed());
    }

    /**
     * @test
     */
    public function GivenASubscribedUser_ThenAutoSubscriptionShouldBeSet()
    {
        $this->assertTrue($this->subscribedUser->isUserAutoSubscribed());
    }

    /**
     * @test
     */
    public function GivenANewUser_WhenUserAutoSubscribe_ThenAutoSubscriptionShouldBeSet()
    {
        $before = $this->unSubscribedUser->isUserAutoSubscribed();
        $this->unSubscribedUser->subscribe();
        $this->assertFalse($before);
        $this->assertTrue($this->unSubscribedUser->isUserAutoSubscribed());
    }

    /**
     * @test
     */
    public function GivenASubscribedUser_WhenUnSubscribe_ThenAutoSubscriptionShouldBeUnSet()
    {
        $before = $this->subscribedUser->isUserAutoSubscribed();
        $this->subscribedUser->unSubscribe();
        $this->assertTrue($before);
        $this->assertFalse($this->subscribedUser->isUserAutoSubscribed());
    }
}
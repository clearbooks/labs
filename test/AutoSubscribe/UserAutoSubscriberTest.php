<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 14:35
 */

namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProviderStub;
use Clearbooks\Labs\AutoSubscribe\Gateway\EmptyAutoSubscriptionProvider;
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
        $userId = 1;
        $autoSubscriptionProvider = new AutoSubscriptionProviderStub([2 => true]);
        $this->unSubscribedUser = new UserAutoSubscriber($userId, $autoSubscriptionProvider);
        $this->subscribedUser = new UserAutoSubscriber(2, $autoSubscriptionProvider);
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
        $this->unSubscribedUser->userAutoSubscribe();
        $this->assertFalse($before);
        $this->assertTrue($this->unSubscribedUser->isUserAutoSubscribed());
    }

    /**
     * @test
     */
    public function GivenASubscribedUser_WhenUnSubscribe_ThenAutoSubscriptionShouldBeUnSet()
    {
        $before = $this->subscribedUser->isUserAutoSubscribed();
        $this->subscribedUser->userUnSubscribe();
        $this->assertTrue($before);
        $this->assertFalse($this->subscribedUser->isUserAutoSubscribed());
    }

}
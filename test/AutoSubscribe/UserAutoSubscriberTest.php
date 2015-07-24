<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 14:35
 */

namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProviderUpdateMock;
use Clearbooks\Labs\AutoSubscribe\Object\UserStub;
use Clearbooks\Labs\AutoSubscribe\UseCase\AutoSubscriber;

class UserAutoSubscriberTest extends \PHPUnit_Framework_TestCase
{
    /** @var AutoSubscriptionProviderUpdateMock */
    private $subscribedProvider;
    /** @var AutoSubscriptionProviderUpdateMock */
    private $unSubscribedProvider;
    /** @var AutoSubscriber */
    private $subscribedUser;
    /** @var AutoSubscriber */
    private $unSubscribedUser;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->subscribedProvider = new AutoSubscriptionProviderUpdateMock(true);
        $this->unSubscribedProvider = new AutoSubscriptionProviderUpdateMock(false);
        $this->subscribedUser = new UserAutoSubscriber(new UserStub(2), $this->subscribedProvider);
        $this->unSubscribedUser = new UserAutoSubscriber(new UserStub(3), $this->unSubscribedProvider);
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
    public function GivenUserAutoSubscriptionWithExistingFalseOrAbsentSubscription_WhenUserAutoSubscribe_ThenAutoSubscriptionProviderUpdateCalledWithTrue()
    {
        $this->unSubscribedUser->subscribe();
        $this->assertTrue($this->unSubscribedProvider->isUpdateCalledWith(true));
    }
    /**
     * @test
     */
    public function GivenUserAutoSubscriptionWithExistingTrueSubscription_WhenUserSubscribe_ThenAutoSubscriptionProviderUpdateShouldNotBeCalled()
    {
        $this->subscribedUser->subscribe();
        $this->assertFalse($this->subscribedProvider->isUpdateCalledWith(true));
    }

    /**
     * @test
     */
    public function GivenUserAutoSubscriptionWithExistingTrueSubscription_WhenUserUnSubscribe_ThenAutoSubscriptionProviderUpdateCalledWithFalse()
    {
        $this->subscribedUser->unSubscribe();
        $this->assertTrue($this->subscribedProvider->isUpdateCalledWith(false));
    }

    /**
     * @test
     */
    public function GivenUserAutoSubscriptionWithExistingFalseOrAbsentSubscription_WhenUserUnSubscribe_ThenAutoSubscriptionProviderUpdateCalledWithFalseOrNotAtAllWithAbsentSubscription()
    {
        $this->unSubscribedUser->unSubscribe();
        $this->assertFalse($this->unSubscribedProvider->isUpdateCalledWith(false));
    }
}
//EOF UserAutoSubscriberTest.php
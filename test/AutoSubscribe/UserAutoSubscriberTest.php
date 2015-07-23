<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 20/07/15
 * Time: 14:35
 */

namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProviderDummyMock;
use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProviderUpdateMock;
use Clearbooks\Labs\AutoSubscribe\Gateway\SingleAutoSubscriptionProviderMock;
use Clearbooks\Labs\AutoSubscribe\Object\FalseSubscription;
use Clearbooks\Labs\AutoSubscribe\Object\SubscriptionSpy;
use Clearbooks\Labs\AutoSubscribe\Object\TrueSubscription;
use Clearbooks\Labs\AutoSubscribe\Object\UserStub;
use Clearbooks\Labs\AutoSubscribe\UseCase\AutoSubscriber;

class UserAutoSubscriberTest extends \PHPUnit_Framework_TestCase
{
    /** @var SubscriptionSpy */
    private $subscribedSubscription;
    /** @var SubscriptionSpy */
    private $unSubscribedSubscription;
    /** @var AutoSubscriptionProviderUpdateMock */
    private $absentSubscriptionProvider;
    /** @var AutoSubscriptionProviderUpdateMock */
    private $subscribedProvider;
    /** @var AutoSubscriptionProviderUpdateMock */
    private $unSubscribedProvider;
    /** @var AutoSubscriber */
    private $absentSubscriptionForUser;
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
        $this->absentSubscriptionProvider = new AutoSubscriptionProviderDummyMock();
        $this->subscribedSubscription = new TrueSubscription();
        $this->unSubscribedSubscription = new FalseSubscription();
        $this->subscribedProvider = new SingleAutoSubscriptionProviderMock($this->subscribedSubscription);
        $this->unSubscribedProvider = new SingleAutoSubscriptionProviderMock($this->unSubscribedSubscription);
        $this->absentSubscriptionForUser = new UserAutoSubscriber(new UserStub(1), $this->absentSubscriptionProvider);
        $this->subscribedUser = new UserAutoSubscriber(new UserStub(2), $this->subscribedProvider);
        $this->unSubscribedUser = new UserAutoSubscriber(new UserStub(3), $this->unSubscribedProvider);
    }

    /**
     * @test
     */
    public function GivenANewUser_ThenAutoSubscriptionShouldBeUnSet()
    {
        $this->assertFalse($this->absentSubscriptionForUser->isUserAutoSubscribed());
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
        $this->absentSubscriptionForUser->subscribe();
        $this->unSubscribedUser->subscribe();
        $this->assertTrue($this->absentSubscriptionProvider->isUpdateCalledWith(true));
        $this->assertTrue($this->unSubscribedSubscription->isSubscribedCalled());
        $this->assertTrue($this->unSubscribedProvider->isUpdateCalledWith(true));
    }
    /**
     * @test
     */
    public function GivenUserAutoSubscriptionWithExistingTrueSubscription_WhenUserSubscribe_ThenAutoSubscriptionProviderUpdateShouldNotBeCalled()
    {
        $this->subscribedUser->subscribe();
        $this->assertFalse($this->subscribedProvider->isUpdateCalledWith(true));
        $this->assertTrue($this->subscribedSubscription->isSubscribedCalled());
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
        $this->absentSubscriptionForUser->unSubscribe();
        $this->unSubscribedUser->unSubscribe();
        $this->assertFalse($this->absentSubscriptionProvider->isUpdateCalledWith(false));
        $this->assertTrue($this->unSubscribedSubscription->isSubscribedCalled());
        $this->assertFalse($this->unSubscribedProvider->isUpdateCalledWith(false));
    }
}
//EOF UserAutoSubscriberTest.php
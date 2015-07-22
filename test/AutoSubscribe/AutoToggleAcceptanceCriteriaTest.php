<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 21/07/15
 * Time: 15:19
 */

namespace Clearbooks\Labs\AutoSubscribe;


use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProviderMock;
use Clearbooks\Labs\AutoSubscribe\Object\MutableSubscription;
use Clearbooks\Labs\AutoSubscribe\Object\UserStub;
use Clearbooks\Labs\AutoSubscribe\UseCase\AutoSubscriber;
use Clearbooks\Labs\Event\ToggleShowEventStub;
use Clearbooks\Labs\Event\ToggleShowEventExecutor;
use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\Event\UseCase\ToggleShowSubscriber;
use Clearbooks\Labs\Event\UseCase\TriggerToggleShow;

class AutoToggleActivationAcceptanceCriteriaTest extends \PHPUnit_Framework_TestCase
{
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
        $user1 = new UserStub(1);
        $user2 = new UserStub(2);
        $user3 = new UserStub(3);
        $autoSubscriptionProvider = new AutoSubscriptionProviderMock([
            new MutableSubscription($user2,true),
            new MutableSubscription($user3,false),
        ]);
        $this->absentSubscriptionForUser = new UserAutoSubscriber($user1, $autoSubscriptionProvider);
        $this->subscribedUser = new UserAutoSubscriber($user2, $autoSubscriptionProvider);
        $this->unSubscribedUser = new UserAutoSubscriber($user3, $autoSubscriptionProvider);
    }

    /**
     * TODO ToggleActivator interface missing
     * @test
     */
    public function GivenASubscribedUser_WhenAToggleIsMadeVisible_ThenSystemAutoSetToggle()
    {
        $subscribers = [$this->subscribedUser, $this->absentSubscriptionForUser, $this->unSubscribedUser];
        $toggleName = 'Feature 1';
        /** @var ToggleShowEvent $event */
        $event = new ToggleShowEventStub($toggleName);
        /** @var TriggerToggleShow $trigger */
        $trigger = new ToggleShowEventExecutor($subscribers);
        $handled = $trigger->raise($event);

        $this->assertTrue($handled);


        // see if a toggle is active

//        $before = $this->subscribedUser->isUserAutoSubscribed();
//        $this->subscribedUser->unSubscribe();
//        $this->assertTrue($before);
//        $this->assertFalse($this->subscribedUser->isUserAutoSubscribed());
    }

    /**
     * TODO ToggleActivator interface missing
     * @test
     */
    public function GivenANonSubscribedUser_WhenAToggleIsMadeVisible_ThenToggleStaysTheSame()
    {
        /** @var ToggleShowEvent $event */
        $event = new ToggleShowEventStub('Feature 1');
        /** @var ToggleShowSubscriber $subscriber */
        $subscriber = $this->subscribedUser;
        /** @var TriggerToggleShow $trigger */
        $trigger = new ToggleShowEventExecutor([$subscriber]);
        $handled = $trigger->raise($event);

        // see if a toggle is active

//        $before = $this->subscribedUser->isUserAutoSubscribed();
//        $this->subscribedUser->unSubscribe();
//        $this->assertTrue($before);
//        $this->assertFalse($this->subscribedUser->isUserAutoSubscribed());
    }
}
//EOF AutoToggleActivationAcceptanceCriteriaTest.php
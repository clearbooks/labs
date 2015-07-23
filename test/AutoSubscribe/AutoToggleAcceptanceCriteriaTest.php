<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 21/07/15
 * Time: 15:19
 */

namespace Clearbooks\Labs\AutoSubscribe;


use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProviderDummyMock;
use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProviderUpdateMock;
use Clearbooks\Labs\AutoSubscribe\Gateway\SingleAutoSubscriptionProviderMock;
use Clearbooks\Labs\AutoSubscribe\Object\FalseSubscription;
use Clearbooks\Labs\AutoSubscribe\Object\SubscriptionSpy;
use Clearbooks\Labs\AutoSubscribe\Object\TrueSubscription;
use Clearbooks\Labs\Event\ToggleShowEventStub;
use Clearbooks\Labs\Event\ToggleShowEventExecutor;
use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\Event\UseCase\TriggerToggleShow;
use Clearbooks\Labs\User\ToggleActivator;

class AutoToggleActivationAcceptanceCriteriaTest extends \PHPUnit_Framework_TestCase
{
    /** @var ToggleActivatorMock */
    private $toggleActivator;
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
        $this->toggleActivator = new ToggleActivatorMock();
    }



    /**
     * TODO ToggleActivator interface missing
     * @test
     */
    public function GivenASubscribedUser_WhenAToggleIsMadeVisible_ThenSystemAutoSetToggle()
    {
        $eventHandler = new AutoSubscriptionToggleShowEventHandlerSpy($this->subscribedProvider, $this->toggleActivator);

        $subscribers = [$eventHandler];
        $toggleName = 'Feature 1';
        /** @var ToggleShowEvent $event */
        $event = new ToggleShowEventStub($toggleName);
        /** @var TriggerToggleShow $trigger */
        $trigger = new ToggleShowEventExecutor($subscribers);
        $handled = $trigger->raise($event);

        $this->assertTrue($handled);
        $this->assertTrue($this->subscribedSubscription->isSubscribedCalled());
        $this->assertTrue($eventHandler->isHandleToggleShowCalledWith($toggleName));
        $this->assertTrue($this->toggleActivator->isExecuteCalledWithToggleName($toggleName));
    }

    /**
     * @test
     */
    public function GivenASubscribedUser_WhenAToggleIsMadeVisibleOnAnInvalidToggle_ThenSystemIgnoresEvent()
    {
        $eventHandler = new AutoSubscriptionToggleShowEventHandlerSpy($this->subscribedProvider, $this->toggleActivator);

        $subscribers = [$eventHandler];
        $toggleName = '';
        /** @var ToggleShowEvent $event */
        $event = new ToggleShowEventStub($toggleName);
        /** @var TriggerToggleShow $trigger */
        $trigger = new ToggleShowEventExecutor($subscribers);
        $handled = $trigger->raise($event);

        $this->assertTrue($eventHandler->isHandleToggleShowCalledWith($toggleName));
        $this->assertFalse($handled);
        $this->assertFalse($this->subscribedSubscription->isSubscribedCalled());
        $this->assertFalse($this->toggleActivator->isExecuteCalledWithToggleName($toggleName));
    }

    /**
     * TODO ToggleActivator interface missing
     * @test
     */
    public function GivenANonSubscribedUser_WhenAToggleIsMadeVisible_ThenToggleStaysTheSame()
    {
        $eventHandler = new AutoSubscriptionToggleShowEventHandlerSpy($this->unSubscribedProvider, $this->toggleActivator);

        $subscribers = [$eventHandler];
        $toggleName = 'Feature 1';
        /** @var ToggleShowEvent $event */
        $event = new ToggleShowEventStub($toggleName);
        /** @var TriggerToggleShow $trigger */
        $trigger = new ToggleShowEventExecutor($subscribers);
        $handled = $trigger->raise($event);

        $this->assertFalse($handled);
        $this->assertTrue($this->unSubscribedSubscription->isSubscribedCalled());
        $this->assertTrue($eventHandler->isHandleToggleShowCalledWith($toggleName));
        $this->assertFalse($this->toggleActivator->isExecuteCalledWithToggleName($toggleName));    }
}
//EOF AutoToggleActivationAcceptanceCriteriaTest.php
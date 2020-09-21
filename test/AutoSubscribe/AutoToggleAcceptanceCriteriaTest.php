<?php
namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriberProvider;
use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriberProviderStub;
use Clearbooks\Labs\AutoSubscribe\Object\UserStub;
use Clearbooks\Labs\Event\ToggleShowEventStub;
use Clearbooks\Labs\Event\ToggleShowEventExecutor;
use Clearbooks\Labs\Event\UseCase\ToggleShowSubscriber;
use Clearbooks\Labs\Event\UseCase\TriggerToggleShow;
use PHPUnit\Framework\TestCase;

class AutoToggleAcceptanceCriteriaTest extends TestCase
{
    const FEATURE_TOGGLE_NAME = 'Feature 1';
    /** @var ToggleStatusModifierSpy */
    private $toggleStatusModifierSpy;
    /** @var AutoSubscriberProvider */
    private $subscribedProvider;
    /** @var AutoSubscriberProvider */
    private $unSubscribedProvider;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->subscribedProvider = new AutoSubscriberProviderStub([new UserStub(1),new UserStub(2)]);
        $this->unSubscribedProvider = new AutoSubscriberProviderStub([]);
        $this->toggleStatusModifierSpy = new ToggleStatusModifierSpy();
    }

    /**
     * @test
     */
    public function GivenASubscribedUser_WhenAToggleIsMadeVisible_ThenSystemAutoSetToggle()
    {
        $eventHandler = new AutoSubscriptionToggleShowEventHandlerSpy($this->subscribedProvider, $this->toggleStatusModifierSpy);
        $toggleName = self::FEATURE_TOGGLE_NAME;

        $handled = $this->riseToggleShowEvent($toggleName, $eventHandler);

        $this->assertTrue($handled);
        $this->assertTrue($eventHandler->isHandleToggleShowCalledWith($toggleName));
        $this->assertEquals([
            $toggleName=>[
                1=>1,
                2=>1,
            ],
        ],$this->toggleStatusModifierSpy->getExecutionArray());
    }

    /**
     * @test
     */
    public function GivenANonSubscribedUser_WhenAToggleIsMadeVisible_ThenShouldNotSetAnything()
    {
        $eventHandler = new AutoSubscriptionToggleShowEventHandlerSpy($this->unSubscribedProvider, $this->toggleStatusModifierSpy);
        $toggleName = self::FEATURE_TOGGLE_NAME;

        $handled = $this->riseToggleShowEvent($toggleName, $eventHandler);

        $this->assertFalse($handled);
        $this->assertTrue($eventHandler->isHandleToggleShowCalledWith($toggleName));
        $this->assertEquals([],$this->toggleStatusModifierSpy->getExecutionArray());
    }

    /**
     * @test
     */
    public function GivenASubscribedUser_WhenAToggleIsMadeVisibleAndToggleNameInvalid_ThenShouldNotSetAnything()
    {
        $eventHandler = new AutoSubscriptionToggleShowEventHandlerSpy($this->subscribedProvider, $this->toggleStatusModifierSpy);
        $toggleName = '';

        $handled = $this->riseToggleShowEvent($toggleName, $eventHandler);

        $this->assertFalse($handled);
        $this->assertTrue($eventHandler->isHandleToggleShowCalledWith($toggleName));
        $this->assertEquals([],$this->toggleStatusModifierSpy->getExecutionArray());
    }

        /**
     * @param string $toggleName
     * @param ToggleShowSubscriber $eventHandler
     * @return bool
     */
    private function riseToggleShowEvent($toggleName,ToggleShowSubscriber $eventHandler)
    {
        /** @var TriggerToggleShow $trigger */
        $trigger = new ToggleShowEventExecutor([$eventHandler]);
        return $trigger->raise(new ToggleShowEventStub($toggleName));
    }
}
//EOF AutoToggleActivationAcceptanceCriteriaTest.php

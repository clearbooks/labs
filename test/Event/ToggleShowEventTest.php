<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 21/07/15
 * Time: 10:57
 */

namespace Clearbooks\Labs\Event;


use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\Event\UseCase\ToggleShowSubscriber;
use Clearbooks\Labs\Event\UseCase\TriggerToggleShow;

class ToggleShowEventTest extends \PHPUnit_Framework_TestCase
{

    public function testGetToggleName()
    {
        /** @var ToggleShowEvent $event */
        $event = new ToggleShowEventStub('Feature 1');
        $this->assertEquals('Feature 1',$event->getToggleName());
    }

    public function testTriggerToggleShowEvent_onEmptySubscribers()
    {
        /** @var ToggleShowEvent $event */
        $event = new ToggleShowEventStub('Feature 1');
        /** @var TriggerToggleShow $trigger */
        $trigger = new TriggerToggleShowBasic([]);
        $handled = $trigger->raise($event);
        $this->assertFalse($handled);
    }

    public function testTriggerToggleShowEvent_OneSubscriberHandlesIt()
    {
        /** @var ToggleShowEvent $event */
        $event = new ToggleShowEventStub('Feature 1');
        /** @var ToggleShowSubscriber $subscriber */
        $subscriber = new ToggleShowSubscriberStub();
        /** @var TriggerToggleShow $trigger */
        $trigger = new TriggerToggleShowBasic([$subscriber]);
        $handled = $trigger->raise($event);
        $this->assertTrue($handled);
    }

    public function testTriggerToggleShowEvent_OneSubscriberNOTHandlesIt()
    {
        /** @var ToggleShowEvent $event */
        $event = new ToggleShowEventStub('Feature 1');
        /** @var ToggleShowSubscriber $subscriber */
        $subscriber = new ToggleShowSubscriberStub(false);
        /** @var TriggerToggleShow $trigger */
        $trigger = new TriggerToggleShowBasic([$subscriber]);
        $handled = $trigger->raise($event);
        $this->assertFalse($handled);
    }

}
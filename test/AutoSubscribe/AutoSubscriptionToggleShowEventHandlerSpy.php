<?php
namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriberProvider;
use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\User\UseCase\UserToggleActivator;

class AutoSubscriptionToggleShowEventHandlerSpy extends AutoSubscriptionToggleShowEventHandler
{
    /** @var string */
    private $handleToggleShowCalledWith = '';

    /**
     * AutoSubscriptionToggleShowEventHandlerSpy constructor.
     * @param AutoSubscriberProvider $autoSubscriberProvider
     * @param UserToggleActivator $toggleActivator
     */
    public function __construct(AutoSubscriberProvider $autoSubscriberProvider,UserToggleActivator $toggleActivator)
    {
        parent::__construct($autoSubscriberProvider, $toggleActivator);
    }

    /**
     * @param ToggleShowEvent $event
     * @return boolean event handled
     */
    public function handleToggleShow(ToggleShowEvent $event)
    {
        $this->handleToggleShowCalledWith = $event->getToggleName();
        return parent::handleToggleShow($event);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isHandleToggleShowCalledWith($name)
    {
        return $this->handleToggleShowCalledWith === $name;
    }
}
//EOF AutoSubscriptionToggleShowEventHandlerSpy.php
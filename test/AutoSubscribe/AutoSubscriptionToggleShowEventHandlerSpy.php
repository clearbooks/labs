<?php
namespace Clearbooks\Labs\AutoSubscribe;

use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriberProvider;
use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\User\UseCase\ToggleStatusModifier;

class AutoSubscriptionToggleShowEventHandlerSpy extends AutoSubscriptionToggleShowEventHandler
{
    /** @var string */
    private $handleToggleShowCalledWith = '';

    /**
     * AutoSubscriptionToggleShowEventHandlerSpy constructor.
     * @param AutoSubscriberProvider $autoSubscriberProvider
     * @param ToggleStatusModifier   $toggleStatusModifier
     */
    public function __construct(AutoSubscriberProvider $autoSubscriberProvider, ToggleStatusModifier $toggleStatusModifier)
    {
        parent::__construct($autoSubscriberProvider, $toggleStatusModifier);
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
<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 23/07/15
 * Time: 13:17
 */

namespace Clearbooks\Labs\AutoSubscribe;


use Clearbooks\Labs\AutoSubscribe\Gateway\AutoSubscriptionProvider;
use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\User\UseCase\ToggleActivator;

class AutoSubscriptionToggleShowEventHandlerSpy extends AutoSubscriptionToggleShowEventHandler
{
    /** @var string */
    private $handleToggleShowCalledWith = '';

    /**
     * AutoSubscriptionToggleShowEventHandlerSpy constructor.
     * @param AutoSubscriptionProvider $autoSubscriptionProvider
     * @param ToggleActivator $toggleActivator
     */
    public function __construct(AutoSubscriptionProvider $autoSubscriptionProvider,ToggleActivator $toggleActivator)
    {
        parent::__construct($autoSubscriptionProvider, $toggleActivator);
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
<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 21/07/15
 * Time: 11:20
 */

namespace Clearbooks\Labs\Event;


use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\Event\UseCase\ToggleShowSubscriber;
use Clearbooks\Labs\Event\UseCase\TriggerToggleShow;

class ToggleShowEventExecutor implements TriggerToggleShow
{
    /**
     * @var ToggleShowSubscriber[]
     */
    private $subscribers;

    /**
     * ToggleShowEventExecutor constructor.
     * @param ToggleShowSubscriber[] $subscribers
     */
    public function __construct($subscribers)
    {
        $this->subscribers = $subscribers;
    }

    /**
     * @param ToggleShowEvent $event
     * @return boolean event handled
     */
    public function raise(ToggleShowEvent $event)
    {
        if ($this->isToggleInvalid($event)) {
            return false;
        }
        $handled = false;
        foreach ($this->subscribers as $s) {
            $handled = $s->handleToggleShow($event) || $handled;
        }
        return $handled;
    }

    /**
     * @param ToggleShowEvent $event
     * @return bool
     */
    private function isToggleInvalid(ToggleShowEvent $event)
    {
        return empty($event->getToggleName());
    }
}
//EOF ToggleShowEventExecutor.php
<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 21/07/15
 * Time: 11:25
 */

namespace Clearbooks\Labs\Event;


use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;
use Clearbooks\Labs\Event\UseCase\ToggleShowSubscriber;

class ToggleShowSubscriberStub implements ToggleShowSubscriber
{
    /** @var bool */
    private $handle = true;

    /**
     * ToggleShowSubscriberStub constructor.
     * @param bool $handle
     */
    public function __construct($handle = true)
    {
        $this->handle = $handle;
    }

    /**
     * @param ToggleShowEvent $event
     * @return bool event handled
     */
    public function handleToggleShow($event)
    {
        return $this->handle;
    }
}
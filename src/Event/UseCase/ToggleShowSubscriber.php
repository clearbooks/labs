<?php
namespace Clearbooks\Labs\Event\UseCase;

interface ToggleShowSubscriber
{
    /**
     * @param ToggleShowEvent $event
     * @return boolean event handled
     */
    public function handleToggleShow(ToggleShowEvent $event);
}
//EOF ToggleShowSubscriber.php
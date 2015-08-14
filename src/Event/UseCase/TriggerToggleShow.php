<?php
namespace Clearbooks\Labs\Event\UseCase;

interface TriggerToggleShow
{
    /**
     * @param ToggleShowEvent $event
     * @return boolean event handled
     */
    public function raise(ToggleShowEvent $event);
}
//EOF TriggerToggleShow.php
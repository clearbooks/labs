<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 21/07/15
 * Time: 11:21
 */

namespace Clearbooks\Labs\Event\UseCase;


interface TriggerToggleShow
{
    /**
     * @param ToggleShowEvent $event
     * @return boolean event handled
     */
    public function raise($event);
}
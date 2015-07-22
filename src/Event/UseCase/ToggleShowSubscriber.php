<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 21/07/15
 * Time: 11:26
 */

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
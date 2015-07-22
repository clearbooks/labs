<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 21/07/15
 * Time: 11:00
 */

namespace Clearbooks\Labs\Event\UseCase;


interface ToggleShowEvent
{
    /**
     * @return string
     */
    public function getToggleName();
}
//EOF ToggleShowEvent.php
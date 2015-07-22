<?php
/**
 * Created by PhpStorm.
 * User: playerone
 * Date: 21/07/15
 * Time: 10:59
 */

namespace Clearbooks\Labs\Event;


use Clearbooks\Labs\Event\UseCase\ToggleShowEvent;

class ToggleShowEventStub implements ToggleShowEvent
{
    /** @var string */
    private $name;

    /**
     * ToggleShowEvent constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getToggleName()
    {
        return $this->name;
    }
}
//EOF ToggleShowEventStub.php
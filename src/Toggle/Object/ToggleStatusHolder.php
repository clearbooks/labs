<?php
namespace Clearbooks\Labs\Toggle\Object;

use Clearbooks\Labs\Toggle\Entity\ToggleStatus;

class ToggleStatusHolder implements ToggleStatus
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var bool
     */
    private $locked;

    /**
     * @param string $id
     * @param bool $active
     * @param bool $locked
     */
    public function __construct( $id, $active, $locked )
    {
        $this->id = $id;
        $this->active = $active;
        $this->locked = $locked;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return boolean
     */
    public function isLocked()
    {
        return $this->locked;
    }
}

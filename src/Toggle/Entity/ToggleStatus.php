<?php
namespace Clearbooks\Labs\Toggle\Entity;

interface ToggleStatus
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return bool
     */
    public function isActive();

    /**
     * @return bool
     */
    public function isLocked();
}

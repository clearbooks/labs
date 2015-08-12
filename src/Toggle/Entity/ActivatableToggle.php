<?php
namespace Clearbooks\Labs\Toggle\Entity;

interface ActivatableToggle
{
    /** @return string */
    public function isActive();
}
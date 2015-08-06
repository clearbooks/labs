<?php
namespace Clearbooks\Labs\Toggle\Entity;

interface ActivatableToggle extends Toggle
{
    /** @return string */
    public function isActive();
}
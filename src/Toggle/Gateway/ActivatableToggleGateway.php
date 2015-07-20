<?php
namespace Clearbooks\Labs\Toggle\Gateway;
use Clearbooks\Labs\Toggle\Entity\ActivatableToggle;

interface ActivatableToggleGateway
{
    /**
     * @param string $name The name of the toggle you seek
     * @return ActivatableToggle
     */
    public function getActivatableToggleByName( $name );
}
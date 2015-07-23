<?php
namespace Clearbooks\Labs\User\UseCase\ToggleActivator;

interface Request
{
    /**
     * @return string
     */
    public function getToggleIdentifier();

    /**
     * @param string $toggleIdentifier
     */
    public function setToggleIdentifier( $toggleIdentifier );
}
//EOF Request.php

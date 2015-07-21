<?php
namespace Clearbooks\Labs\User\UseCase;

interface ToggleService
{
    /**
     * @param string $toggleIdentifier
     * @return bool
     */
    public function activateToggle( $toggleIdentifier );
}
//EOF ToggleService.php

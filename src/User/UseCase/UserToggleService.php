<?php
namespace Clearbooks\Labs\User\UseCase;

interface UserToggleService
{
    /**
     * @param string $toggleIdentifier
     * @return bool
     */
    public function activateToggle( $toggleIdentifier );
}
//EOF UserToggleService.php

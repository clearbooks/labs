<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\UserToggleService;

class SuccessfulUserToggleService implements UserToggleService
{
    /**
     * @param string $toggleIdentifier
     * @return bool
     */
    public function activateToggle( $toggleIdentifier )
    {
        return true;
    }
}
//EOF SuccessfulUserToggleService.php

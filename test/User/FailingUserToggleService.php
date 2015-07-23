<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\UserToggleService;

class FailingUserToggleService implements UserToggleService
{
    /**
     * @param string $toggleIdentifier
     * @return bool
     */
    public function activateToggle( $toggleIdentifier )
    {
        return false;
    }
}
//EOF FailingUserToggleService.php

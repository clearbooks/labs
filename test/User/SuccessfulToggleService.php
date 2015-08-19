<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleService;

class SuccessfulToggleService implements ToggleService
{
    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function activateToggle( $toggleIdentifier, $userIdentifier )
    {
        return true;
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function deActivateToggle( $toggleIdentifier, $userIdentifier )
    {
        return true;
    }
}
//EOF SuccessfulToggleService.php

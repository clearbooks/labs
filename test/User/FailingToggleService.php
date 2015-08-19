<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleService;

class FailingToggleService implements ToggleService
{
    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function activateToggle( $toggleIdentifier, $userIdentifier )
    {
        return false;
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function deActivateToggle( $toggleIdentifier, $userIdentifier )
    {
        return false;
    }
}
//EOF FailingToggleService.php

<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\GroupToggleService;

class SuccessfulGroupToggleService implements GroupToggleService
{
    /**
     * @param string $toggleIdentifier
     * @param int    $groupIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function activateToggle( $toggleIdentifier, $groupIdentifier, $userIdentifier )
    {
        return true;
    }
}
//EOF SuccessfulGroupToggleService.php

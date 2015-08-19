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
    public function activateToggleForUser( $toggleIdentifier, $userIdentifier )
    {
        return true;
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function deActivateToggleForUser( $toggleIdentifier, $userIdentifier )
    {
        return true;
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $groupIdentifier
     * @param  int   $actingUserIdentifier
     * @return bool
     */
    public function activateToggleForGroup( $toggleIdentifier, $groupIdentifier, $actingUserIdentifier )
    {
        return true;
    }

    /**
     * @param string  $toggleIdentifier
     * @param  int    $groupIdentifier
     * @param     int $actingUserIdentifier
     * @return bool
     */
    public function deActivateToggleForGroup( $toggleIdentifier, $groupIdentifier, $actingUserIdentifier )
    {
        return true;
    }
}
//EOF SuccessfulToggleService.php

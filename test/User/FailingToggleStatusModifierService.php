<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleStatusModifierService;

class FailingToggleStatusModifierService implements ToggleStatusModifierService
{
    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function activateToggleForUser( $toggleIdentifier, $userIdentifier )
    {
        return false;
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function deActivateToggleForUser( $toggleIdentifier, $userIdentifier )
    {
        return false;
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $groupIdentifier
     * @param  int   $actingUserIdentifier
     * @return bool
     */
    public function activateToggleForGroup( $toggleIdentifier, $groupIdentifier, $actingUserIdentifier )
    {
        return false;
    }

    /**
     * @param string  $toggleIdentifier
     * @param  int    $groupIdentifier
     * @param     int $actingUserIdentifier
     * @return bool
     */
    public function deActivateToggleForGroup( $toggleIdentifier, $groupIdentifier, $actingUserIdentifier )
    {
        return false;
    }

    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function unsetToggleForUser( $toggleIdentifier, $userIdentifier )
    {
        return false;
    }

    /**
     * @param string $toggleIdentifier
     * @param  int   $groupIdentifier
     * @param  int   $actingUserIdentifier
     * @return bool
     */
    public function unsetToggleForGroup( $toggleIdentifier, $groupIdentifier, $actingUserIdentifier )
    {
        return false;
    }
}
//EOF FailingToggleStatusModifierService.php

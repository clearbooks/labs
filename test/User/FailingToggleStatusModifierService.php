<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleStatusModifierService;

class FailingToggleStatusModifierService implements ToggleStatusModifierService
{
    /**
     * @param string $toggleIdentifier
     * @param string $toggleStatus
     * @param int    $userIdentifier
     * @return bool
     */
    public function setToggleStatusForUser( $toggleIdentifier, $toggleStatus, $userIdentifier )
    {
        return false;
    }

    /**
     * @param string $toggleIdentifier
     * @param string $toggleStatus
     * @param int    $groupIdentifier
     * @param int    $actingUserIdentifier
     * @return bool
     */
    public function setToggleStatusForGroup( $toggleIdentifier, $toggleStatus, $groupIdentifier, $actingUserIdentifier )
    {
        return false;
    }
}
//EOF FailingToggleStatusModifierService.php

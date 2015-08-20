<?php
namespace Clearbooks\Labs\User\UseCase;

interface ToggleStatusModifierService
{
    /**
     * @param string $toggleIdentifier
     * @param string $toggleStatus
     * @param int    $userIdentifier
     * @return bool
     */
    public function setToggleStatusForUser( $toggleIdentifier, $toggleStatus, $userIdentifier );

    /**
     * @param string $toggleIdentifier
     * @param string $toggleStatus
     * @param int    $groupIdentifier
     * @param int    $actingUserIdentifier
     * @return bool
     */
    public function setToggleStatusForGroup( $toggleIdentifier, $toggleStatus, $groupIdentifier, $actingUserIdentifier );
}
//EOF ToggleStatusModifierService.php

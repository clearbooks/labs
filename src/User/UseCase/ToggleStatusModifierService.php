<?php
namespace Clearbooks\Labs\User\UseCase;

interface ToggleStatusModifierService
{
    /**
     * @param string   $toggleIdentifier
     * @param int      $userIdentifier
     * @return bool
     */
    public function activateToggleForUser( $toggleIdentifier, $userIdentifier );

    /**
     * @param string   $toggleIdentifier
     * @param int      $userIdentifier
     * @return bool
     */
    public function deActivateToggleForUser( $toggleIdentifier, $userIdentifier );

    /**
     * @param string   $toggleIdentifier
     * @param int      $userIdentifier
     * @return bool
     */
    public function unsetToggleForUser( $toggleIdentifier, $userIdentifier );

    /**
     * @param string $toggleIdentifier
     * @param int    $groupIdentifier
     * @param  int   $actingUserIdentifier
     * @return bool
     */
    public function activateToggleForGroup( $toggleIdentifier, $groupIdentifier, $actingUserIdentifier );

    /**
     * @param string  $toggleIdentifier
     * @param  int    $groupIdentifier
     * @param  int    $actingUserIdentifier
     * @return bool
     */
    public function deActivateToggleForGroup( $toggleIdentifier, $groupIdentifier, $actingUserIdentifier );

    /**
     * @param string  $toggleIdentifier
     * @param  int    $groupIdentifier
     * @param  int    $actingUserIdentifier
     * @return bool
     */
    public function unsetToggleForGroup( $toggleIdentifier, $groupIdentifier, $actingUserIdentifier );
}
//EOF ToggleStatusModifierService.php
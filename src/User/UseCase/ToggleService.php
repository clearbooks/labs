<?php
namespace Clearbooks\Labs\User\UseCase;

interface ToggleService
{
    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function activateToggle( $toggleIdentifier, $userIdentifier );

    /**
     * @param string $toggleIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function deActivateToggle( $toggleIdentifier, $userIdentifier );
}
//EOF ToggleService.php

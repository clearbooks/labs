<?php
namespace Clearbooks\Labs\User\UseCase;

interface GroupToggleService
{
    /**
     * @param string $toggleIdentifier
     * @param int    $groupIdentifier
     * @param int    $userIdentifier
     * @return bool
     */
    public function activateToggle( $toggleIdentifier, $groupIdentifier, $userIdentifier );
}
//EOF GroupToggleService.php

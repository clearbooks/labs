<?php
namespace Clearbooks\Labs\User\UseCase;

interface PermissionService
{
    /**
     * @param int $userIdentifier
     * @param int $groupIdentifier
     * @return bool
     */
    public function isGroupAdmin( $userIdentifier, $groupIdentifier );
}
//EOF PermissionService.php

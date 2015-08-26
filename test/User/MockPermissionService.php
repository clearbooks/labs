<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\PermissionService;

class MockPermissionService implements PermissionService
{
    /**
     * @var array
     */
    private $groupAdminData = [ ];

    /**
     * @param int $userIdentifier
     * @param int $groupIdentifier
     */
    public function addAsGroupAdmin( $userIdentifier, $groupIdentifier )
    {
        if ( !isset( $this->groupAdminData[$groupIdentifier] ) ) {
            $this->groupAdminData[$groupIdentifier] = [ ];
        }

        if ( in_array( $userIdentifier, $this->groupAdminData[$groupIdentifier] ) ) {
            return;
        }

        $this->groupAdminData[$groupIdentifier][] = $userIdentifier;
    }

    /**
     * @param int $userIdentifier
     * @param int $groupIdentifier
     * @return bool
     */
    public function isGroupAdmin( $userIdentifier, $groupIdentifier )
    {
        return isset( $this->groupAdminData[$groupIdentifier] ) && in_array( $userIdentifier,
                                                                             $this->groupAdminData[$groupIdentifier] );
    }
}
//EOF MockPermissionService.php

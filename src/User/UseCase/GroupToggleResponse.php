<?php
namespace Clearbooks\Labs\User\UseCase;

interface GroupToggleResponse extends ToggleResponse
{
    const ERROR_UNKNOWN_GROUP = 5;
    const ERROR_USER_IS_NOT_GROUP_ADMIN = 6;

    /**
     * @return int
     */
    public function getGroupIdentifier();

    /**
     * @param int $groupIdentifier
     */
    public function setGroupIdentifier( $groupIdentifier );
}
//EOF GroupToggleResponse.php

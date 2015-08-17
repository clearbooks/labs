<?php
namespace Clearbooks\Labs\User\UseCase;

interface GroupToggleRequest extends ToggleRequest
{
    /**
     * @return int
     */
    public function getGroupIdentifier();

    /**
     * @param int $groupIdentifier
     */
    public function setGroupIdentifier( $groupIdentifier );
}
//EOF GroupToggleRequest.php

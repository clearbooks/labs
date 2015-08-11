<?php
namespace Clearbooks\Labs\User\UseCase;

interface GroupToggleRequest
{
    /**
     * @return string
     */
    public function getToggleIdentifier();

    /**
     * @param string $toggleIdentifier
     */
    public function setToggleIdentifier( $toggleIdentifier );

    /**
     * @return int
     */
    public function getGroupIdentifier();

    /**
     * @param int $groupIdentifier
     */
    public function setGroupIdentifier( $groupIdentifier );

    /**
     * @return int
     */
    public function getUserIdentifier();

    /**
     * @param int $userIdentifier
     */
    public function setUserIdentifier( $userIdentifier );
}
//EOF GroupToggleRequest.php

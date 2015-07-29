<?php
namespace Clearbooks\Labs\User\UseCase;

interface UserToggleRequest
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
    public function getUserIdentifier();

    /**
     * @param int $userIdentifier
     */
    public function setUserIdentifier( $userIdentifier );
}
//EOF UserToggleRequest.php

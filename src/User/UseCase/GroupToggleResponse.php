<?php
namespace Clearbooks\Labs\User\UseCase;

interface GroupToggleResponse
{
    const ERROR_UNKNOWN_ERROR = 0;
    const ERROR_UNKNOWN_TOGGLE = 1;
    const ERROR_UNKNOWN_USER = 2;
    const ERROR_TOGGLE_ALREADY_ACTIVE = 3;
    const ERROR_TOGGLE_NOT_ACTIVE = 4;
    const ERROR_UNKNOWN_GROUP = 5;

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

    /**
     * @return int[]
     */
    public function getErrors();

    /**
     * @param int[] $errors
     */
    public function setErrors( array $errors );
}
//EOF GroupToggleResponse.php

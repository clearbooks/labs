<?php
namespace Clearbooks\Labs\User\UseCase\ToggleStatusModifier;

interface Response
{
    const ERROR_UNKNOWN_ERROR = 0;
    const ERROR_UNKNOWN_TOGGLE = 1;
    const ERROR_INVALID_TOGGLE_STATUS = 2;
    const ERROR_UNKNOWN_USER = 3;
    const ERROR_TOGGLE_ALREADY_ACTIVE = 4;
    const ERROR_TOGGLE_NOT_ACTIVE = 5;
    const ERROR_UNKNOWN_GROUP = 6;
    const ERROR_USER_IS_NOT_GROUP_ADMIN = 7;

    /**
     * @return string
     */
    public function getToggleIdentifier();

    /**
     * @param string $toggleIdentifier
     */
    public function setToggleIdentifier( $toggleIdentifier );

    /**
     * @return string
     */
    public function getNewToggleStatus();

    /**
     * @param string $toggleStatus
     */
    public function setNewToggleStatus( $toggleStatus );

    /**
     * @return int
     */
    public function getUserIdentifier();

    /**
     * @param int $userIdentifier
     */
    public function setUserIdentifier( $userIdentifier );

    /**
     * @return int|null
     */
    public function getGroupIdentifier();

    /**
     * @param int $groupIdentifier
     */
    public function setGroupIdentifier( $groupIdentifier );

    /**
     * @return int[]
     */
    public function getErrors();

    /**
     * @param int[] $errors
     */
    public function setErrors( array $errors );
}
//EOF Response.php

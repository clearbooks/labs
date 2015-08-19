<?php
namespace Clearbooks\Labs\User\UseCase;

interface ToggleResponse
{
    const ERROR_UNKNOWN_ERROR = 0;
    const ERROR_UNKNOWN_TOGGLE = 1;
    const ERROR_UNKNOWN_USER = 2;
    const ERROR_TOGGLE_ALREADY_ACTIVE = 3;
    const ERROR_TOGGLE_NOT_ACTIVE = 4;

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

    /**
     * @return int[]
     */
    public function getErrors();

    /**
     * @param int[] $errors
     */
    public function setErrors( array $errors );
}
//EOF ToggleResponse.php

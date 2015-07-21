<?php
namespace Clearbooks\Labs\User\UseCase\ToggleActivator;

interface Response
{
    const ERROR_UNKNOWN_ERROR = 0;
    const ERROR_UNKNOWN_TOGGLE = 1;
    const ERROR_TOGGLE_ALREADY_ACTIVE = 2;

    /**
     * @return string
     */
    public function getToggleIdentifier();

    /**
     * @param string $toggleIdentifier
     */
    public function setToggleIdentifier( $toggleIdentifier );

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

<?php
namespace Clearbooks\Labs\User\UseCase\ToggleActivator;

interface Response
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
     * @return int|null
     */
    public function getError();

    /**
     * @param int|null $error
     */
    public function setError( $error );
}
//EOF Response.php

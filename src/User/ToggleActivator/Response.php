<?php
namespace Clearbooks\Labs\User\ToggleActivator;

class Response implements \Clearbooks\Labs\User\UseCase\ToggleActivator\Response
{
    /**
     * @var string
     */
    private $toggleIdentifier;

    /**
     * @var int|null
     */
    private $error = null;

    /**
     * @return int|null
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param int|null $error
     */
    public function setError( $error )
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getToggleIdentifier()
    {
        return $this->toggleIdentifier;
    }

    /**
     * @param string $toggleIdentifier
     */
    public function setToggleIdentifier( $toggleIdentifier )
    {
        $this->toggleIdentifier = $toggleIdentifier;
    }
}
//EOF Response.php

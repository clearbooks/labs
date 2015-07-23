<?php
namespace Clearbooks\Labs\User\ToggleActivator;

class Response implements \Clearbooks\Labs\User\UseCase\ToggleActivator\Response
{
    /**
     * @var string
     */
    private $toggleIdentifier;

    /**
     * @var int[]
     */
    private $errors = [ ];

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

    /**
     * @return int[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param int[] $errors
     */
    public function setErrors( array $errors )
    {
        $this->errors = $errors;
    }
}
//EOF Response.php

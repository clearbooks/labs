<?php
namespace Clearbooks\Labs\User\UserToggleActivator;

class Response implements \Clearbooks\Labs\User\UseCase\UserToggleActivator\Response
{
    /**
     * @var string
     */
    private $toggleIdentifier;

    /**
     * @var int
     */
    private $userIdentifier;

    /**
     * @var int[]
     */
    private $errors = [ ];

    public function __construct( $toggleIdentifier, $userIdentifier, array $errors = [ ] )
    {
        $this->setToggleIdentifier( $toggleIdentifier );
        $this->setUserIdentifier( $userIdentifier );
        $this->setErrors( $errors );
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

    /**
     * @return int
     */
    public function getUserIdentifier()
    {
        return $this->userIdentifier;
    }

    /**
     * @param int $userIdentifier
     */
    public function setUserIdentifier( $userIdentifier )
    {
        $this->userIdentifier = $userIdentifier;
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

<?php
namespace Clearbooks\Labs\User\UserToggleActivator;

class Request implements \Clearbooks\Labs\User\UseCase\UserToggleActivator\Request
{
    /**
     * @var string
     */
    private $toggleIdentifier;

    /**
     * @var int
     */
    private $userIdentifier;

    public function __construct( $toggleIdentifier, $userIdentifier )
    {
        $this->setToggleIdentifier( $toggleIdentifier );
        $this->setUserIdentifier( $userIdentifier );
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
}
//EOF Request.php

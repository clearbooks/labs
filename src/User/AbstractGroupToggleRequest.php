<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\GroupToggleRequest;

abstract class AbstractGroupToggleRequest implements GroupToggleRequest
{
    /**
     * @var string
     */
    private $toggleIdentifier;

    /**
     * @var int
     */
    private $groupIdentifier;

    /**
     * @var int
     */
    private $userIdentifier;

    public function __construct( $toggleIdentifier, $groupIdentifier, $userIdentifier )
    {
        $this->setToggleIdentifier( $toggleIdentifier );
        $this->setGroupIdentifier( $groupIdentifier );
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
    public function getGroupIdentifier()
    {
        return $this->groupIdentifier;
    }

    /**
     * @param int $groupIdentifier
     */
    public function setGroupIdentifier( $groupIdentifier )
    {
        $this->groupIdentifier = $groupIdentifier;
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
//EOF AbstractGroupToggleRequest.php

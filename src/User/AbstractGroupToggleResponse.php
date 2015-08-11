<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\GroupToggleResponse;

abstract class AbstractGroupToggleResponse implements GroupToggleResponse
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

    /**
     * @var int[]
     */
    private $errors = [ ];

    public function __construct( $toggleIdentifier, $groupIdentifier, $userIdentifier, array $errors = [ ] )
    {
        $this->setToggleIdentifier( $toggleIdentifier );
        $this->setGroupIdentifier( $groupIdentifier );
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
//EOF AbstractGroupToggleResponse.php

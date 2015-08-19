<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\ToggleResponse;

abstract class AbstractToggleResponse implements ToggleResponse
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
     * @var int
     */
    private $groupIdentifier;

    /**
     * @var int[]
     */
    private $errors = [ ];

    public function __construct( $toggleIdentifier, $userIdentifier, $groupIdentifier = null, array $errors = [ ] )
    {
        $this->setToggleIdentifier( $toggleIdentifier );
        $this->setUserIdentifier( $userIdentifier );
        $this->setGroupIdentifier( $groupIdentifier );
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
     * @return int|null
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
//EOF AbstractToggleResponse.php

<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\GroupToggleResponse;

abstract class AbstractGroupToggleResponse extends AbstractToggleResponse implements GroupToggleResponse
{
    /**
     * @var int
     */
    private $groupIdentifier;

    public function __construct( $toggleIdentifier, $groupIdentifier, $userIdentifier, array $errors = [ ] )
    {
        parent::__construct( $toggleIdentifier, $userIdentifier, $errors );
        $this->setGroupIdentifier( $groupIdentifier );
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
}
//EOF AbstractGroupToggleResponse.php

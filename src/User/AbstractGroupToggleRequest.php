<?php
namespace Clearbooks\Labs\User;

use Clearbooks\Labs\User\UseCase\GroupToggleRequest;

abstract class AbstractGroupToggleRequest extends AbstractToggleRequest implements GroupToggleRequest
{
    /**
     * @var int
     */
    private $groupIdentifier;

    public function __construct( $toggleIdentifier, $groupIdentifier, $userIdentifier )
    {
        parent::__construct( $toggleIdentifier, $userIdentifier );
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
//EOF AbstractGroupToggleRequest.php

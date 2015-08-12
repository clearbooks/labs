<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 04/08/15
 */

namespace Clearbooks\Labs\Toggle\Gateway;


use Clearbooks\Labs\Toggle\Entity\GroupToggle;

class StubGroupToggleGateway implements GroupToggleGateway
{
    /**
     * @var GroupToggle[]
     */
    private $toggles;

    /**
     * Construct this StubGroupToggleGateway.
     * @author Ryan Wood <ryanw@clearbooks.co.uk>
     * @param $toggles
     */
    public function __construct( $toggles )
    {
        $this->toggles = $toggles;
    }

    /**
     * @return GroupToggle[]
     */
    public function getAllGroupToggles()
    {
        return $this->toggles;
    }
}
//EOF StubGroupToggleGateway.php
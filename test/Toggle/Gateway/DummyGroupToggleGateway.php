<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 04/08/15
 */

namespace Clearbooks\Labs\Toggle\Gateway;


use Clearbooks\Labs\Toggle\Entity\GroupToggle;

class DummyGroupToggleGateway implements GroupToggleGateway
{
    /**
     * @return GroupToggle[]
     */
    public function getAllGroupToggles()
    {
        return [];
    }
}
//EOF DummyGroupToggleGateway.php
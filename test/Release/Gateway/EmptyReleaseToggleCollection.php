<?php
namespace Clearbooks\Labs\Release\Gateway;

use Clearbooks\Labs\Toggle\Entity\MarketableToggle;

class EmptyReleaseToggleCollection implements ReleaseToggleCollection
{
    /**
     * @param string $releaseId
     * @return MarketableToggle[]
     */
    public function getTogglesForRelease( $releaseId )
    {
        return [];
    }
}
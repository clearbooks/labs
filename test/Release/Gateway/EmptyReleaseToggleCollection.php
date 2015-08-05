<?php
namespace Clearbooks\Labs\Release\Gateway;

use Clearbooks\Labs\Toggle\Entity\Toggle;

class EmptyReleaseToggleCollection implements ReleaseToggleCollection
{
    /**
     * @param string $releaseId
     * @return Toggle[]
     */
    public function getTogglesForRelease( $releaseId )
    {
        return [];
    }
}
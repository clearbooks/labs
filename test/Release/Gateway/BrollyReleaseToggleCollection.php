<?php
namespace Clearbooks\Labs\Release\Gateway;

use Clearbooks\Labs\Toggle\Entity\Brolly;
use Clearbooks\Labs\Toggle\Entity\Toggle;

class BrollyReleaseToggleCollection implements ReleaseToggleCollection
{

    /**
     * @param string $releaseId
     * @return Toggle[]
     */
    public function getTogglesForRelease( $releaseId )
    {
        return [ new Brolly() ];
    }
}
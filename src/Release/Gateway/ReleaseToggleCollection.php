<?php
namespace Clearbooks\Labs\Release\Gateway;

use Clearbooks\Labs\Toggle\Entity\Toggle;

interface ReleaseToggleCollection
{
    /**
     * @param string $releaseId
     * @return Toggle[]
     */
    public function getTogglesForRelease( $releaseId );
}
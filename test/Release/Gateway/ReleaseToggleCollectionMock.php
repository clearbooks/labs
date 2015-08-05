<?php
namespace Clearbooks\Labs\Release\Gateway;

use Clearbooks\Labs\Toggle\Entity\Toggle;

class ReleaseToggleCollectionMock implements ReleaseToggleCollection
{
    /** @var string */
    public $releaseId;

    /**
     * @param string $releaseId
     * @return Toggle[]
     */
    public function getTogglesForRelease( $releaseId )
    {
        $this->releaseId = $releaseId;
        return [];
    }
}
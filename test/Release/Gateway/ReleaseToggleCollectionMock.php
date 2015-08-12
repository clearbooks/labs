<?php
namespace Clearbooks\Labs\Release\Gateway;

use Clearbooks\Labs\Toggle\Entity\MarketableToggle;

class ReleaseToggleCollectionMock implements ReleaseToggleCollection
{
    /** @var string */
    public $releaseId;

    /**
     * @param string $releaseId
     * @return MarketableToggle[]
     */
    public function getTogglesForRelease( $releaseId )
    {
        $this->releaseId = $releaseId;
        return [];
    }
}
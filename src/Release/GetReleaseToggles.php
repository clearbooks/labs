<?php
namespace Clearbooks\Labs\Release;

use Clearbooks\Labs\Toggle\Entity\MarketingToggle;
use Clearbooks\Labs\Toggle\Entity\ReleasableToggle;
use Clearbooks\Labs\Toggle\Entity\Toggle;

class GetReleaseToggles
{
    /** @var Gateway\ReleaseToggleCollection */
    private $releaseToggleCollection;

    /**
     * @param Gateway\ReleaseToggleCollection $releaseToggleCollection
     */
    public function __construct( Gateway\ReleaseToggleCollection $releaseToggleCollection )
    {
        $this->releaseToggleCollection = $releaseToggleCollection;
    }

    /**
     * @param string $releaseId
     * @return GetReleaseToggles\ResponseToggle[]
     */
    public function execute( $releaseId )
    {
        return \array_map( function( MarketingToggle $toggle ) {
            return new GetReleaseToggles\ResponseToggle( $toggle->getName() );
        }, (array) $this->releaseToggleCollection->getTogglesForRelease( $releaseId ) );
    }
}
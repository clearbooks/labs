<?php
namespace Clearbooks\Labs\Release;

use Clearbooks\Labs\Toggle\Entity\MarketableToggle;

class GetReleaseToggles implements UseCase\GetReleaseToggles
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
        return \array_map( function( MarketableToggle $toggle ) {
            return new GetReleaseToggles\ResponseToggle( $toggle->getId(), $toggle->getName(), $toggle->getDescriptionOfToggle() );
        }, (array) $this->releaseToggleCollection->getTogglesForRelease( $releaseId ) );
    }
}
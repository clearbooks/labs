<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 04/08/15
 */

namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Release\Gateway\ReleaseGateway;
use Clearbooks\Labs\Toggle\Entity\GroupToggle;
use Clearbooks\Labs\Toggle\Gateway\GroupToggleGateway;

class GetGroupTogglesForRelease
{
    /**
     * @var GroupToggleGateway
     */
    private $gateway;
    /**
     * @var ReleaseGateway
     */
    private $releaseGateway;

    /**
     * Construct this GetGroupTogglesForRelease.
     * @author Ryan Wood <ryanw@clearbooks.co.uk>
     * @param GroupToggleGateway $gateway
     * @param ReleaseGateway $releaseGateway
     */
    public function __construct( GroupToggleGateway $gateway, ReleaseGateway $releaseGateway )
    {
        $this->gateway = $gateway;
        $this->releaseGateway = $releaseGateway;
    }

    public function execute( $releaseId )
    {
        return $this->getTogglesForVisibleRelease( $releaseId, $this->gateway->getAllGroupToggles() );
    }

    /**
     * @param $releaseId
     * @param $groupToggles
     * @return array
     */
    private function getTogglesForVisibleRelease( $releaseId, $groupToggles )
    {
        if ( $this->releaseIsVisible( $releaseId ) ) {
            return $this->filterTogglesByReleaseId( $releaseId, $groupToggles );
        }
        return [ ];
    }

    /**
     * @param $releaseId
     * @param $groupToggles
     * @return array
     */
    private function filterTogglesByReleaseId( $releaseId, $groupToggles )
    {
        $groupTogglesForRelease = [ ];
        foreach ( $groupToggles as $toggle ) {
            /** @var GroupToggle $toggle */
            if ( $toggle->getRelease() == $releaseId ) {
                $groupTogglesForRelease[] = $toggle;
            }
        }
        return $groupTogglesForRelease;
    }

    /**
     * @param $releaseId
     * @return bool
     */
    private function releaseIsVisible( $releaseId )
    {
        return $this->releaseGateway->getRelease( $releaseId )->isVisible();
    }

}
//EOF GetGroupTogglesForRelease.php
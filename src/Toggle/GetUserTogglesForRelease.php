<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 03/08/2015
 * Time: 15:06
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Release\Gateway\ReleaseGateway;
use Clearbooks\Labs\Toggle\Entity\UserToggle;
use Clearbooks\Labs\Toggle\Gateway\UserToggleGateway;

class GetUserTogglesForRelease
{
    /**
     * @var ReleaseGateway
     */
    private $gateway;
    /**
     * @var ReleaseGateway
     */
    private $releaseGateway;

    /**
     * GetUserTogglesForRelease constructor.
     * @param UserToggleGateway $gateway
     * @param ReleaseGateway $releaseGateway
     */
    public function __construct( UserToggleGateway $gateway, ReleaseGateway $releaseGateway )
    {
        $this->gateway = $gateway;
        $this->releaseGateway = $releaseGateway;
    }

    public function execute( $releaseId )
    {
        $togglesArray = $this->gateway->getAllUserToggles();
        $availableToggles = [ ];
        if ( $this->releaseGateway->getRelease( $releaseId )->isVisible() ) {
            $availableToggles = $this->getUserTogglesFromRelease( $releaseId, $togglesArray, $availableToggles );
        }
        return $availableToggles;
    }

    /**
     * @param $releaseId
     * @param UserToggle []
     * @param $availableToggles
     * @return array
     */
    private function getUserTogglesFromRelease( $releaseId, $togglesArray, $availableToggles )
    {
        foreach ( $togglesArray as $toggle ) {
            /** @var UserToggle $toggle */
            $release = $toggle->getRelease();
            if ( $release == $releaseId ) {
                $availableToggles[] = $toggle;
            }
        }
        return $availableToggles;
    }

}
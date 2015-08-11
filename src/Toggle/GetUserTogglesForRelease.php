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
     * @var UserToggleGateway
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

    /**
     * @param string $releaseId
     * @return UserToggle[]
     */
    public function execute( $releaseId )
    {
        $togglesArray = $this->gateway->getAllUserToggles();
        $availableToggles = [ ];
        if ( $this->isReleaseVisible( $releaseId ) ) {
            $availableToggles = $this->getUserTogglesFromRelease( $releaseId, $togglesArray, $availableToggles );
        }
        return $availableToggles;
    }

    /**
     * @param string $releaseId
     * @param UserToggle [] $togglesArray
     * @param UserToggle[] $availableToggles
     * @return UserToggle[]
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

    /**
     * @param string $releaseId
     * @return bool
     */
    private function isReleaseVisible( $releaseId )
    {
        return $this->releaseGateway->getRelease( $releaseId )->isVisible();
    }

}
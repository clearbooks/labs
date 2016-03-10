<?php
namespace Clearbooks\Labs\Toggle\Gateway;

use Clearbooks\Labs\Toggle\Entity\MarketableToggle;

class GetTogglesVisibleWithoutReleaseGatewayStub implements GetUserTogglesVisibleWithoutReleaseGateway, GetGroupTogglesVisibleWithoutReleaseGateway
{
    /**
     * @var MarketableToggle[]
     */
    private $groupTogglesVisibleWithoutRelease = [ ];

    /**
     * @var MarketableToggle[]
     */
    private $userTogglesVisibleWithoutRelease = [ ];

    /**
     * @return MarketableToggle[]
     */
    public function getGroupTogglesVisibleWithoutRelease()
    {
        return $this->groupTogglesVisibleWithoutRelease;
    }

    /**
     * @return MarketableToggle[]
     */
    public function getUserTogglesVisibleWithoutRelease()
    {
        return $this->userTogglesVisibleWithoutRelease;
    }

    /**
     * @param MarketableToggle[] $groupTogglesVisibleWithoutRelease
     */
    public function setGroupTogglesVisibleWithoutRelease( $groupTogglesVisibleWithoutRelease )
    {
        $this->groupTogglesVisibleWithoutRelease = $groupTogglesVisibleWithoutRelease;
    }

    /**
     * @param MarketableToggle[] $userTogglesVisibleWithoutRelease
     */
    public function setUserTogglesVisibleWithoutRelease( $userTogglesVisibleWithoutRelease )
    {
        $this->userTogglesVisibleWithoutRelease = $userTogglesVisibleWithoutRelease;
    }
}

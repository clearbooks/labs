<?php
namespace Clearbooks\Labs\Toggle\Gateway;

use Clearbooks\Labs\Toggle\Entity\MarketableToggle;

interface GetGroupTogglesVisibleWithoutReleaseGateway
{
    /**
     * @return MarketableToggle[]
     */
    public function getGroupTogglesVisibleWithoutRelease();
}

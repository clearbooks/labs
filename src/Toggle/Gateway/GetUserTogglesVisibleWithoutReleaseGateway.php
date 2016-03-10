<?php
namespace Clearbooks\Labs\Toggle\Gateway;

use Clearbooks\Labs\Toggle\Entity\MarketableToggle;

interface GetUserTogglesVisibleWithoutReleaseGateway
{
    /**
     * @return MarketableToggle[]
     */
    public function getUserTogglesVisibleWithoutRelease();
}

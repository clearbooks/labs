<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 10/08/2015
 * Time: 10:18
 */

namespace Clearbooks\Labs\Toggle\Gateway;

interface MarketableToggleGateway
{
    /**
     * @param string $toggleId
     * @param array $marketingInformation
     */
    public function setMarketingInformationForToggle( $toggleId, $marketingInformation );
}
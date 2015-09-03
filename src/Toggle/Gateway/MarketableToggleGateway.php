<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 10/08/2015
 * Time: 10:18
 */

namespace Clearbooks\Labs\Toggle\Gateway;


use Clearbooks\Labs\Toggle\UseCase\CreateMarketingInformationForToggle\CreateMarketingInformationRequest;

interface MarketableToggleGateway
{
    /**
     * @param string $toggleId
     * @param array $marketingInformation
     */
    public function setMarketingInformationForToggle( $toggleId, $marketingInformation );
}
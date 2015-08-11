<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 10/08/2015
 * Time: 10:18
 */

namespace Clearbooks\Labs\Toggle\Gateway;


use Clearbooks\Labs\Toggle\Entity\CreateMarketingInformationRequest;

interface MarketableToggleGateway
{
    /**
     * @param CreateMarketingInformationRequest $request
     */
    public function setMarketingInformationForToggle( CreateMarketingInformationRequest $request );
}
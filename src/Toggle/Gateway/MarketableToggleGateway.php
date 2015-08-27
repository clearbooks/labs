<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 10/08/2015
 * Time: 10:18
 */

namespace Clearbooks\Labs\Toggle\Gateway;


use Clearbooks\Labs\Toggle\UseCase\CreateMarketingInformationForToggle\MarketingInformationRequest;

interface MarketableToggleGateway
{
    /**
     * @param MarketingInformationRequest $request
     */
    public function setMarketingInformationForToggle( MarketingInformationRequest $request );
}
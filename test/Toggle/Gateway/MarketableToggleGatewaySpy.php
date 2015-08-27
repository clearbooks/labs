<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 10/08/2015
 * Time: 10:32
 */

namespace Clearbooks\Labs\Toggle\Gateway;


use Clearbooks\Labs\Toggle\Entity\CreateMarketingInformationRequest;
use Clearbooks\Labs\Toggle\UseCase\CreateMarketingInformationForToggle\MarketingInformationRequest;

class MarketableToggleGatewaySpy implements MarketableToggleGateway
{

    /**
     * @var string[]
     */
    private $marketingInfo = [ ];

    /**
     * @param MarketingInformationRequest $request
     */
    public function setMarketingInformationForToggle( MarketingInformationRequest $request )
    {
        $this->marketingInfo = [ $request->getToggleId(), $request->getImageLink(), $request->getDescriptionOfToggle(), $request->getDescriptionOfFunctionality(),
            $request->getDescriptionOfReasonForImplementation(), $request->getDescriptionOfLocation(),
            $request->getLinkToGuide(),
            $request->getAppNotificationText() ];
    }

    /**
     * @return string[]
     */
    public function getMarketingInfo()
    {
        return $this->marketingInfo;
    }
}
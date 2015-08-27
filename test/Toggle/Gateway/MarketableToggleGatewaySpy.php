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
     * @param string $toggleId
     * @param array $marketingInformation
     */
    public function setMarketingInformationForToggle( $toggleId, $marketingInformation )
    {
        $this->marketingInfo = [
            $toggleId,
            $marketingInformation['screenshot_urls'],
            $marketingInformation['description_of_toggle'],
            $marketingInformation['description_of_functionality'],
            $marketingInformation['description_of_implementation_reason'],
            $marketingInformation['description_of_location'],
            $marketingInformation['guide_url'],
            $marketingInformation['app_notification_copy_text']
        ];
    }

    /**
     * @return string[]
     */
    public function getMarketingInfo()
    {
        return $this->marketingInfo;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 10/08/2015
 * Time: 10:32
 */

namespace Clearbooks\Labs\Toggle\Gateway;


class MarketableToggleGatewaySpy implements MarketableToggleGateway
{

    /**
     * @var string[]
     */
    private $marketingInfo = [ ];

    /**
     * @return void
     */
    public function setMarketingInformationForToggle( $imageLink, $descriptionToggle, $descriptionFunctionally,
                                                      $descriptionOfReasonForImplementation, $descriptionOfLocation,
                                                      $linkToGuide,
                                                      $appNotificationText )
    {
        $this->marketingInfo = [ $imageLink, $descriptionToggle, $descriptionFunctionally,
            $descriptionOfReasonForImplementation, $descriptionOfLocation,
            $linkToGuide,
            $appNotificationText ];
    }


    /**
     * @return string[]
     */
    public function getMarketingInfo()
    {
        return $this->marketingInfo;
    }
}
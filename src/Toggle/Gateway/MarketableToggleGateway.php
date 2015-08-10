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
     * @return void
     */
    public function setMarketingInformationForToggle( $imageLink, $descriptionToggle, $descriptionFunctionally,
                                                      $descriptionOfReasonForImplementation, $descriptionOfLocation,
                                                      $linkToGuide,
                                                      $appNotificationText );
}
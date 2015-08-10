<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 06/08/2015
 * Time: 09:26
 */

namespace Clearbooks\Labs\Toggle;


class CreateMarketingInformationForToggleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function givenNoMarketingInformation_CreateMarketingInformationForToggle_SendsEmptyStringToGateway()
    {
        $response = $this->createMarketingInformationFroToggle( "", "", "", "", "", "", "" );
        $this->assertEquals( [""], $response );
    }

    /**
     * @param string $imageLink
     * @param string $descriptionToggle
     * @param string $descriptionFunctionally
     * @param string $descriptionOfReasonForImplementation
     * @param string $descriptionOfLocation
     * @param string $linkToGuide
     * @param string $appNotificationText
     * @return string[]
     */
    private function createMarketingInformationFroToggle( $gateway, $imageLink, $descriptionToggle, $descriptionFunctionally,
                                                          $descriptionOfReasonForImplementation, $descriptionOfLocation,
                                                          $linkToGuide, $appNotificationText )
    {
        ( new CreateMarketingInformationForToggle($gateway) )->execute( $imageLink, $descriptionToggle,
            $descriptionFunctionally, $descriptionOfReasonForImplementation, $descriptionOfLocation, $linkToGuide,
            $appNotificationText );
        return [""];
    }

}

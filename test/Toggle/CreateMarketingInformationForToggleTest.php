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
        $response = $this->createMarketingInformationFroToggle("","","","","","","");
    }

    /**
     * @return string
     */
    private function createMarketingInformationFroToggle($imageLink, $descriptionToggle, $descriptionFunctionally, $descriptionOfReasonForImplementation, $descriptionOfLocation, $linkToGuide, $appNotificationText)
    {
        return "";
    }

}

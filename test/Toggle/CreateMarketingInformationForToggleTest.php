<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 06/08/2015
 * Time: 09:26
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Toggle\Gateway\MarketableToggleGateway;
use Clearbooks\Labs\Toggle\Gateway\MarketableToggleGatewaySpy;

class CreateMarketingInformationForToggleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function givenEmptyStringAsMarketingInformation_CreateMarketingInformationForToggle_SetsMarketingInformationToEmptyString()
    {
        $response = $this->createMarketingInformationFroToggle( new MarketableToggleGatewaySpy(), "", "", "", "", "",
            "", "" );
        $this->assertEquals( [ "", "", "", "", "", "", "" ], $response );
    }

    /**
     * @test
     */
    public function givenNull_CreateMarketingInformationForToggle_SetsMarketingInformationToEmptyString()
    {
        $response = $this->createMarketingInformationFroToggle( new MarketableToggleGatewaySpy(), null, null, null,
            null, null, null, null );
        $this->assertEquals( [ "", "", "", "", "", "", "" ], $response );
    }

    /**
     * @test
     */
    public function givenMarketingInformation_CreateMarketingInformationForToggle_SetsMarketingInformationToGivenMarketingInformation()
    {
        $response = $this->createMarketingInformationFroToggle( new MarketableToggleGatewaySpy(), "This", "is", "a",
            "test", "of", "Marketing", "information" );
        $this->assertEquals( [ "This", "is", "a", "test", "of", "Marketing", "information" ], $response );
    }

    /**
     * @test
     */
    public function givenDifferentDataType_CreateMarketingInformationForToggle_SetsMarketingInformationToGivenInformationAsString()
    {
        $response = $this->createMarketingInformationFroToggle( new MarketableToggleGatewaySpy(), 1, 2.1, true, 4353536,
            "", null, -1 );
        $this->assertEquals( [ "1", "2.1", "1", "4353536", "", "", "-1" ], $response );
    }

    /**
     * @param MarketableToggleGatewaySpy $gateway
     * @param string $imageLink
     * @param string $descriptionToggle
     * @param string $descriptionFunctionally
     * @param string $descriptionOfReasonForImplementation
     * @param string $descriptionOfLocation
     * @param string $linkToGuide
     * @param string $appNotificationText
     * @return string[]
     */
    private function createMarketingInformationFroToggle( $gateway, $imageLink, $descriptionToggle,
                                                          $descriptionFunctionally,
                                                          $descriptionOfReasonForImplementation, $descriptionOfLocation,
                                                          $linkToGuide, $appNotificationText )
    {
        ( new CreateMarketingInformationForToggle( $gateway ) )->execute( $imageLink, $descriptionToggle,
            $descriptionFunctionally, $descriptionOfReasonForImplementation, $descriptionOfLocation, $linkToGuide,
            $appNotificationText );

        return $gateway->getMarketingInfo();
    }

}

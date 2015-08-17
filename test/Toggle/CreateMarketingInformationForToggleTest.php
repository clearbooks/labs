<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 06/08/2015
 * Time: 09:26
 */

namespace Clearbooks\Labs\Toggle;


use Clearbooks\Labs\Toggle\Entity\CreateMarketingInformationRequest;
use Clearbooks\Labs\Toggle\Gateway\MarketableToggleGateway;
use Clearbooks\Labs\Toggle\Gateway\MarketableToggleGatewaySpy;

class CreateMarketingInformationForToggleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function givenNoParameters_CreateMarketingInformationForToggle_SetsMarketingInformationToEmptyString()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1 );
        $response = $this->createMarketingInformationFroToggle( new MarketableToggleGatewaySpy(),
            $marketingInformation );
        $this->assertEquals( [ "1", "", "", "", "", "", "", "" ], $response );
    }

    /**
     * @test
     */
    public function givenEmptyStringAsMarketingInformation_CreateMarketingInformationForToggle_SetsMarketingInformationToEmptyString()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1, "", "", "", "", "",
            "", "" );
        $response = $this->createMarketingInformationFroToggle( new MarketableToggleGatewaySpy(),
            $marketingInformation );
        $this->assertEquals( [ "1", "", "", "", "", "", "", "" ], $response );
    }

    /**
     * @test
     */
    public function givenNull_CreateMarketingInformationForToggle_SetsMarketingInformationToEmptyString()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1, null, null, null,
            null, null, null, null );
        $response = $this->createMarketingInformationFroToggle( new MarketableToggleGatewaySpy(),
            $marketingInformation );
        $this->assertEquals( [ "1", "", "", "", "", "", "", "" ], $response );
    }

    /**
     * @test
     */
    public function givenMarketingInformation_CreateMarketingInformationForToggle_SetsMarketingInformationToGivenMarketingInformation()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1, "This", "is", "a",
            "test", "of", "Marketing", "information" );
        $response = $this->createMarketingInformationFroToggle( new MarketableToggleGatewaySpy(),
            $marketingInformation );
        $this->assertEquals( [ "1", "This", "is", "a", "test", "of", "Marketing", "information" ], $response );
    }

    /**
     * @test
     */
    public function givenDifferentDataType_CreateMarketingInformationForToggle_SetsMarketingInformationToGivenInformationAsString()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1, 1, 2.1, true, 4353536,
            "", null, -1 );
        $response = $this->createMarketingInformationFroToggle( new MarketableToggleGatewaySpy(),
            $marketingInformation );
        $this->assertEquals( [ "1", "1", "2.1", "1", "4353536", "", "", "-1" ], $response );
    }

    /**
     * @test
     */
    public function givenNotAllParamaters_CreateMarketingInformationForToggle_SetsEmptyStringForMissinParameters()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1, "hello", "this",
            "is a test", 123 );
        $response = $this->createMarketingInformationFroToggle( new MarketableToggleGatewaySpy(),
            $marketingInformation );
        $this->assertEquals( [ "1", "hello", "this", "is a test", "123", "", "", "" ], $response );
    }

    /**
     * @param MarketableToggleGatewaySpy $gateway
     * @param CreateMarketingInformationRequest $request
     * @return \string[]
     */
    private function createMarketingInformationFroToggle( $gateway, CreateMarketingInformationRequest $request )
    {
        ( new CreateMarketingInformationForToggle( $gateway ) )->execute( $request );

        return $gateway->getMarketingInfo();
    }

}
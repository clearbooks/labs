<?php
/**
 * Created by PhpStorm.
 * User: Vovaxs
 * Date: 06/08/2015
 * Time: 09:26
 */

namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Toggle\Gateway\MarketableToggleGatewaySpy;
use Clearbooks\Labs\Toggle\CreateMarketingInformationForToggle\CreateMarketingInformationRequest;
use PHPUnit\Framework\TestCase;

class CreateMarketingInformationForToggleTest extends TestCase
{
    /**
     * @var MarketableToggleGatewaySpy
     */
    private $marketableToggleGateway;

    public function setUp(): void
    {
        $this->marketableToggleGateway = new MarketableToggleGatewaySpy();
    }

    /**
     * @test
     */
    public function givenNoParameters_CreateMarketingInformationForToggle_SetsMarketingInformationToEmptyString()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1 );
        $response = $this->createMarketingInformationFroToggle( $marketingInformation );
        $this->assertEquals( [ "1", "", "", "", "", "", "", "" ], $response );
    }

    /**
     * @test
     */
    public function givenEmptyStringAsMarketingInformation_CreateMarketingInformationForToggle_SetsMarketingInformationToEmptyString()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1, "", "", "", "", "",
            "", "" );
        $response = $this->createMarketingInformationFroToggle( $marketingInformation );
        $this->assertEquals( [ "1", "", "", "", "", "", "", "" ], $response );
    }

    /**
     * @test
     */
    public function givenNull_CreateMarketingInformationForToggle_SetsMarketingInformationToEmptyString()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1, null, null, null,
            null, null, null, null );
        $response = $this->createMarketingInformationFroToggle( $marketingInformation );
        $this->assertEquals( [ "1", "", "", "", "", "", "", "" ], $response );
    }

    /**
     * @test
     */
    public function givenMarketingInformation_CreateMarketingInformationForToggle_SetsMarketingInformationToGivenMarketingInformation()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1, "This", "is", "a",
            "test", "of", "Marketing", "information" );
        $response = $this->createMarketingInformationFroToggle( $marketingInformation );
        $this->assertEquals( [ "1", "This", "is", "a", "test", "of", "Marketing", "information" ], $response );
    }

    /**
     * @test
     */
    public function givenDifferentDataType_CreateMarketingInformationForToggle_SetsMarketingInformationToGivenInformationAsString()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1, 1, 2.1, true, 4353536,
            "", null, -1 );
        $response = $this->createMarketingInformationFroToggle( $marketingInformation );
        $this->assertEquals( [ "1", "1", "2.1", "1", "4353536", "", "", "-1" ], $response );
    }

    /**
     * @test
     */
    public function givenNotAllParamaters_CreateMarketingInformationForToggle_SetsEmptyStringForMissinParameters()
    {
        $marketingInformation = new CreateMarketingInformationRequest( 1, "hello", "this",
            "is a test", 123 );
        $response = $this->createMarketingInformationFroToggle( $marketingInformation );
        $this->assertEquals( [ "1", "hello", "this", "is a test", "123", "", "", "" ], $response );
    }

    /**
     * @param CreateMarketingInformationRequest $request
     * @return \string[]
     */
    private function createMarketingInformationFroToggle( CreateMarketingInformationRequest $request )
    {
        ( new CreateMarketingInformationForToggle( $this->marketableToggleGateway ) )->execute( $request );

        return $this->marketableToggleGateway->getMarketingInfo();
    }
}

<?php
namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Toggle\Entity\Brolly;
use Clearbooks\Labs\Toggle\Entity\MarketableToggle;
use Clearbooks\Labs\Toggle\Entity\Parasol;
use Clearbooks\Labs\Toggle\Gateway\GetTogglesVisibleWithoutReleaseGatewayStub;
use Clearbooks\Labs\Toggle\Object\GetTogglesVisibleWithoutReleaseResponse;

class GetUserTogglesVisibleWithoutReleaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GetTogglesVisibleWithoutReleaseGatewayStub
     */
    private $getTogglesVisibleWithoutReleaseGatewayStub;

    /**
     * @var GetUserTogglesVisibleWithoutRelease
     */
    private $getUserTogglesVisibleWithoutRelease;

    public function setUp()
    {
        parent::setUp();
        $this->getTogglesVisibleWithoutReleaseGatewayStub = new GetTogglesVisibleWithoutReleaseGatewayStub();
        $this->getUserTogglesVisibleWithoutRelease = new GetUserTogglesVisibleWithoutRelease(
                $this->getTogglesVisibleWithoutReleaseGatewayStub
        );
    }

    /**
     * @param MarketableToggle[] $expected
     * @param GetTogglesVisibleWithoutReleaseResponse $response
     */
    private function assertTogglesEqual( array $expected, GetTogglesVisibleWithoutReleaseResponse $response )
    {
        $this->assertEquals( $expected, $response->getToggles() );
    }

    /**
     * @test
     */
    public function GivenNoToggles_ExpectEmptyArray()
    {
        $response = $this->getUserTogglesVisibleWithoutRelease->execute();
        $this->assertTogglesEqual( [ ], $response );
    }

    /**
     * @test
     */
    public function GivenSomeToggles_ExpectTogglesReturned()
    {
        $toggles = [
            new Brolly(),
            new Parasol()
        ];

        $this->getTogglesVisibleWithoutReleaseGatewayStub->setUserTogglesVisibleWithoutRelease( $toggles );
        $response = $this->getUserTogglesVisibleWithoutRelease->execute();
        $this->assertTogglesEqual( $toggles, $response );
    }
}

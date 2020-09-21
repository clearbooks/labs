<?php
namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Toggle\Entity\Brolly;
use Clearbooks\Labs\Toggle\Entity\MarketableToggle;
use Clearbooks\Labs\Toggle\Entity\Parasol;
use Clearbooks\Labs\Toggle\Gateway\GetTogglesVisibleWithoutReleaseGatewayStub;
use Clearbooks\Labs\Toggle\Object\GetTogglesVisibleWithoutReleaseResponse;
use PHPUnit\Framework\TestCase;

class GetGroupTogglesVisibleWithoutReleaseTest extends TestCase
{
    /**
     * @var GetTogglesVisibleWithoutReleaseGatewayStub
     */
    private $getTogglesVisibleWithoutReleaseGatewayStub;

    /**
     * @var GetGroupTogglesVisibleWithoutRelease
     */
    private $getGroupTogglesVisibleWithoutRelease;

    public function setUp(): void
    {
        parent::setUp();
        $this->getTogglesVisibleWithoutReleaseGatewayStub = new GetTogglesVisibleWithoutReleaseGatewayStub();
        $this->getGroupTogglesVisibleWithoutRelease = new GetGroupTogglesVisibleWithoutRelease(
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
        $response = $this->getGroupTogglesVisibleWithoutRelease->execute();
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

        $this->getTogglesVisibleWithoutReleaseGatewayStub->setGroupTogglesVisibleWithoutRelease( $toggles );
        $response = $this->getGroupTogglesVisibleWithoutRelease->execute();
        $this->assertTogglesEqual( $toggles, $response );
    }
}

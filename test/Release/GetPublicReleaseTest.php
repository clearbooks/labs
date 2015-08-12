<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 30/07/2015
 * Time: 14:25
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\Gateway\MockReleaseGateway;
use Clearbooks\Labs\Release\Gateway\StubReleaseGateway;
use DateInterval;
use DateTime;

class GetPublicReleaseTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    /**
     * @test
     */
    public function givenNoPublicReleaseIsFound_onPublicReleaseRequestReturnsEmptyArray()
    {
        $response = $this->getPublicRelease( new StubReleaseGateway() );
        $this->assertEquals( [ ], $response );
    }

    /**
     * @test
     */
    public function givenPublicReleaseExists_GetPublicReleaseReturnsArrayOfReleases()
    {
        $expectedRelease = new Release( "TestRelease", "ClearBooks", self::getDate( 'd/m/Y', '10/07/2015' ), true );
        $expectedRelease2 = new Release( "TestRelease2", "ClearBooks2", self::getFutureDate(), true );
        $unexpectedRelease = new Release( "TestRelease3", "ClearBooks3", self::getFutureDate() );
        $response = $this->getPublicRelease( new MockReleaseGateway( [ 1 => $expectedRelease, 2 => $expectedRelease2, 3 => $unexpectedRelease ] ) );
        $this->assertEquals( [ $expectedRelease, $expectedRelease2 ], $response );
    }

    /**
     * @test
     */
    public function givenPublicReleaseInThePast_GetPublicReleaseReturnsArrayOfReleases()
    {
        $expectedRelease = new Release( "TestRelease", "ClearBooks", self::getDate( 'd/m/Y', '10/07/2015' ) );
        $unexpectedRelease = new Release( "TestRelease3", "ClearBooks3", self::getFutureDate() );
        $response = $this->getPublicRelease( new MockReleaseGateway( [ 1 => $expectedRelease, 2 => $unexpectedRelease ] ) );
        $this->assertEquals( [ $expectedRelease ], $response );

    }

    /**
     * @param MockReleaseGateway/StubReleaseGateway $gateway
     * @return \PublicRelease|int
     */
    private function getPublicRelease( $gateway )
    {
        return ( new GetPublicRelease( $gateway, new DateTime() ) )->execute();
    }

    /**
     * @param string $format
     * @param DateTime $date
     * @return DateTime
     */
    private function getDate( $format, $date )
    {
        return DateTime::createFromFormat( $format, $date );
    }

    /**
     * @return DateTime
     */
    private function getFutureDate()
    {

        return ( new DateTime() )->modify( '+1 day' );
    }

}

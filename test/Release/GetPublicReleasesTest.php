<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 30/07/2015
 * Time: 14:25
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\Gateway\MockPublicReleaseGateway;
use DateTime;

class GetPublicReleaseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function givenNoPublicReleaseIsFound_onPublicReleaseRequestReturnsEmptyArray()
    {
        $response = $this->getPublicRelease( new MockPublicReleaseGateway( [ ] ) );
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
        $response = $this->getPublicRelease( new MockPublicReleaseGateway( [ 1 => $expectedRelease, 2 => $expectedRelease2, 3 => $unexpectedRelease ] ) );
        $this->assertEquals( [ $expectedRelease, $expectedRelease2 ], $response );
    }

    /**
     * @test
     */
    public function givenPublicReleaseInThePast_GetPublicReleaseReturnsArrayOfReleases()
    {
        $expectedRelease = new Release( "TestRelease", "ClearBooks", self::getDate( 'd/m/Y', '10/07/2015' ) );
        $unexpectedRelease = new Release( "TestRelease3", "ClearBooks3", self::getFutureDate() );
        $response = $this->getPublicRelease( new MockPublicReleaseGateway( [ 1 => $expectedRelease, 2 => $unexpectedRelease ] ) );
        $this->assertEquals( [ $expectedRelease ], $response );

    }

    /**
     * @param MockReleaseGateway /StubReleaseGateway $gateway
     * @return \PublicRelease|int
     */
    private function getPublicRelease( $gateway )
    {
        return ( new GetPublicReleases( $gateway ) )->execute();
    }

    /**
     * @param string $format
     * @param \DateTimeInterface $date
     * @return \DateTimeInterface
     */
    private function getDate( $format, $date )
    {
        return DateTime::createFromFormat( $format, $date );
    }

    /**
     * @return \DateTimeInterface
     */
    private function getFutureDate()
    {

        return ( new DateTime() )->modify( '+1 day' );
    }

}

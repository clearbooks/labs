<?php
/**
 * Created by PhpStorm.
 * User: Volodymyr
 * Date: 30/07/2015
 * Time: 11:04
 */

namespace Clearbooks\Labs\Release;


use Clearbooks\Labs\Release\Gateway\DummyReleaseGateway;
use Clearbooks\Labs\Release\Gateway\MockReleaseGateway;
use Clearbooks\Labs\Release\Gateway\ReleaseGateway;
use Clearbooks\Labs\Release\Gateway\StubReleaseGateway;

class GetReleaseTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
    }

    /**
     * @test
     */
    public function givenInvalidID_getReleaseReturnsInvalidIDError()
    {
        $response = $this->getRelease( null, new DummyReleaseGateway() );
        $this->assertEquals( GetRelease::INVALID_ID_ERROR, $response );
    }

    /**
     * @test
     */
    public function givenValidID_withNoRelease_getReleaseReturnsNoReleaseFoundError()
    {
        $response = $this->getRelease( -1, new StubReleaseGateway() );
        $this->assertEquals( GetRelease::NO_RELEASE_FOUND, $response );

    }

    /**
     * @test
     */
    public function givenValidID_withRelease_getReleaseReturnsRelease()
    {
        $expectedRelease = new Release( "TestRelease", "ClearBooks",
            \DateTime::createFromFormat( 'd/m/Y', '10/07/2015' ) );
        $response = $this->getRelease( 2, new MockReleaseGateway( [ 2 => $expectedRelease ] ) );
        $this->assertEquals( $expectedRelease, $response );

    }

    /**
     * @param string $id
     * @param ReleaseGateway $gateway
     * @return Release|int
     */
    private function getRelease( $id, ReleaseGateway $gateway )
    {
        return ( new GetRelease( $gateway ) )->execute( $id );
    }
}
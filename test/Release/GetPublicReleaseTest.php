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
        $expectedRelease = new Release( "TestRelease", "ClearBooks", true );
        $expectedRelease2 = new Release( "TestRelease2", "ClearBooks2", true );
        $unexpectedRelease = new Release( "TestRelease3", "ClearBooks3" );
        $response = $this->getPublicRelease( new MockReleaseGateway( [ 1 => $expectedRelease, 2 => $expectedRelease2, 3 => $unexpectedRelease ] ) );
        $this->assertEquals( [ $expectedRelease, $expectedRelease2 ], $response );
    }

    /**
     * @param $gateway
     * @param $id
     * @return Release|int
     */
    private function getPublicRelease( $gateway )
    {
        return ( new GetPublicRelease( $gateway ) )->execute();
    }
}

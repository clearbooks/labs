<?php
/**
 * @author: Ryan Wood <ryanw@clearbooks.co.uk>
 * @created: 04/08/15
 */

namespace Clearbooks\Labs\Toggle;

use Clearbooks\Labs\Release\Gateway\ConfigurableVisibilityReleaseGatewayMock;
use Clearbooks\Labs\Toggle\Entity\GroupToggleStub;
use Clearbooks\Labs\Toggle\Gateway\StubGroupToggleGateway;

class GetGroupTogglesForReleaseTest extends \PHPUnit_Framework_TestCase
{

    const RELEASE_ID = 1;

    /**
     * @param array $toggles
     * @param bool $visibilityFlag
     * @return Entity\GroupToggle[]
     */
    private function getGroupTogglesForRelease( $toggles, $visibilityFlag = true )
    {
        $gateway = new StubGroupToggleGateway( $toggles );
        $releaseGateway = new ConfigurableVisibilityReleaseGatewayMock( $visibilityFlag );
        return ( new GetGroupTogglesForRelease( $gateway, $releaseGateway ) )->execute( self::RELEASE_ID );
    }

    /**
     * @test
     */
    public function givenNoGroupTogglesInRelease_GetGroupTogglesForReleaseReturnsEmptyArray()
    {
        $toggles = $this->getGroupTogglesForRelease( [] );
        $this->assertEquals( [], $toggles );
    }

    /**
     * @test
     */
    public function givenReleaseNotVisible_GetGroupTogglesForReleaseReturnsEmptyArray()
    {
        $toggles = $this->getGroupTogglesForRelease( [ new GroupToggleStub( self::RELEASE_ID ) ], false );
        $this->assertEquals( [ ], $toggles );
    }

    /**
     * @test
     */
    public function givenVisibleRelease_AndAvailableGroupToggles_GetGroupTogglesForReleaseReturnsToggles()
    {
        $expectedToggles = [ new GroupToggleStub( self::RELEASE_ID ) ];
        $toggles = $this->getGroupTogglesForRelease( $expectedToggles );
        $this->assertEquals( $expectedToggles, $toggles );
    }

    /**
     * @test
     */
    public function givenVisibleRelease_AndAvailableGroupTogglesForDifferentReleases_ReturnsTogglesFromSpecifiedRelease()
    {
        $expectedToggles = new GroupToggleStub( self::RELEASE_ID );
        $unexpectedToggles = new GroupToggleStub( 2 );
        $toggles = $this->getGroupTogglesForRelease( [ $expectedToggles, $unexpectedToggles ] );
        $this->assertEquals( [ $expectedToggles ], $toggles );
    }
}
//EOF GetGroupTogglesForReleaseTest.php